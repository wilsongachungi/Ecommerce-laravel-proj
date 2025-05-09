<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    public function view(Request $request)
    {
        $user = $request->user();
        $userAddress = null;

        if ($user) {
            $cartItems = CartItem::where('user_id', $user->id)->get();
            $userAddress = UserAddress::where('user_id', $user->id)->where('isMain', 1)->first();

            if ($cartItems->count() > 0) {
                return Inertia::render('User/CartList', [
                    'cart' => new CartResource(Cart::getProductsAndCartItems()),
                    'userAddress' => $userAddress,
                ]);
            }
        }

        // Guest or no user cart items
        $cartItems = Cart::getCookieCartItems();

        if (count($cartItems) > 0) {
            return Inertia::render('User/CartList', [
                'cart' => new CartResource(Cart::getProductsAndCartItems()),
                'userAddress' => $userAddress,
            ]);
        }

        return redirect()->route('home'); // fallback
    }


    public function store(Request $request, Product $product)
    {
        // Get quantity from request, default to 1 if not set
        $quantity = $request->post('quantity', 1);
        $user = $request->user();

        if ($user) {
            // Try to find existing cart item for this user and product
            $cartItem = CartItem::where([
                'user_id' => $user->id,
                'product_id' => $product->id
            ])->first();

            if ($cartItem) {
                // If item exists, increment quantity
                $cartItem->increment('quantity', $quantity);
            } else {
                // Create new cart item for user
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            // For guests, use cookies
            $cartItems = Cart::getCookieCartItems();
            $isProductExists = false;

            // Loop by reference to update existing product quantity
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] += $quantity;
                    $isProductExists = true;
                    break;
                }
            }

            if (!$isProductExists) {
                // Add new item to cookie cart
                $cartItems[] = (object) [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }

            // Save updated cookie cart
            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back()->with('success', 'Cart added successfully');
    }


    public function update(Request $request, Product $product)
    {
        $quantity = $request->integer('quantity');
        $user = $request->user();

        if ($user) {
            // Update quantity in DB cart
            CartItem::where(['user_id' => $user->id, 'product_id' => $product->id])
                ->update(['quantity' => $quantity]);
        } else {
            // Update quantity in cookie cart
            $cartItems = Cart::getCookieCartItems();

            foreach ($cartItems as &$item) {
                if ($item['product_id'] == $product->id) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }

            // Re-save updated cookie cart items
            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back();
    }


    public function delete(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user) {
            // Delete the user's cart item if it exists
            CartItem::where([
                'user_id' => $user->id,
                'product_id' => $product->id
            ])->first()?->delete();

            // Check if the user has any more cart items
            if (CartItem::where('user_id', $user->id)->count() <= 0) {
                return redirect()->route('home')->with('info', 'Your cart is empty!');
            }

            return redirect()->back()->with('success', 'Item removed successfully');
        } else {
            // Guest user - handle via cookies
            $cartItems = Cart::getCookieCartItems();

            foreach ($cartItems as $i => $item) {
                if ($item->product_id === $product->id) {
                    array_splice($cartItems, $i, 1); // Remove item from cart
                    break;
                }
            }

            Cart::setCookieCartItems($cartItems);

            if (count($cartItems) <= 0) {
                return redirect()->route('home')->with('info', 'Your cart is empty!');
            }

            return redirect()->back()->with('success', 'Item removed successfully');
        }
    }
}
