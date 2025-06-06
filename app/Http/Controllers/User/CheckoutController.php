<?php

namespace App\Http\Controllers\User;

use Exeption;
use App\Helper\Cart;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Payment;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $carts = $request->carts;
        $products = $request->products;

        $mergedData = [];

        // Merge cart items with their corresponding product details
        foreach ($carts as $cartItem) {
            foreach ($products as $product) {
                if ($cartItem['product_id'] == $product['id']) {
                    $mergedData[] = array_merge(
                        $cartItem,
                        [
                            'title' => $product['title'],
                            'price' => $product['price']
                        ]
                    );
                }
            }
        }

        // Stripe payment
        $stripe = new \Stripe\StripeClient(env('STRIPE_KEY'));
        $lineItems = [];

        foreach ($mergedData as $item) {
            $quantity = max(1, (int) $item['quantity']); // prevent 0 or negative quantity

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'kes',
                    'product_data' => [
                        'name' => $item['title'],
                    ],
                    'unit_amount' => (int)($item['price'] * 100),
                ],
                'quantity' => $quantity,
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Save address if provided
        $newAddress = $request->address;
        if ($newAddress && $newAddress['address1'] != null) {
            // Set previous main address to non-main
            UserAddress::where('isMain', 1)->update(['isMain' => 0]);

            $address = new UserAddress();
            $address->address1 = $newAddress['address1'];
            $address->state = $newAddress['state'];
            $address->zipcode = $newAddress['zipcode'];
            $address->city = $newAddress['city'];
            $address->country_code = $newAddress['country_code'];
            $address->type = $newAddress['type'];
            $address->user_id = Auth::id();
            $address->isMain = 1;
            $address->save();
        }

        $mainAddress = $user->user_address()->where('isMain', 1)->first();

        if($mainAddress){
            $order = new Order();
            $order->status = 'unpaid';
            $order->total_price = $request->total;
            $order->session_id = $checkout_session->id;
            $order->created_by = $user->id;
            //if a main address with isMain = 1 exists, set it id as customer_address_id

            $order->user_address_id = $mainAddress->id;
            $order->save();

            $cartItems = CartItem::where(['user_id'=>$user->id])->get();
            foreach($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->product->price,
                ]);
                $cartItem->delete();
                //remove cart item from cookie
                $cartItems = Cart::getCookieCartItems();
                foreach($cartItems as $item) {
                    unset($item);
                }
                array_splice($cartItems,0, count($cartItems));
                Cart::setCookieCartItems($cartItems);
            }

            $paymentData = [
                'order_id' => $order->id,
                'amount' => $request->total,
                'status' => 'pending',
                'type' => 'stripe',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            Payment::create($paymentData);
        }

        return Inertia::location($checkout_session->url);

    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY')); // Correct initialization

        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if (!$session) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            }

            $order = Order::where('session_id', $session->id)->first();

            if (!$order) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            }

            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) { // ✅ fixed typo: \Exeption ➝ \Exception
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }

}
