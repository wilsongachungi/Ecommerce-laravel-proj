<?php
namespace App\Helper;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Cart {
    public static function getCount() {
        if($user = auth()->user()){
            return CartItem::whereUserId($user->id)->sum('quantity');
        }else{
          return array_reduce(self::getCookieCartItems(), fn($carry, $item) => $carry + $item['quantity'], 0);
        }
    }

    public static function getCartItems()
    {
        if ($user = auth()->user()) {
            return CartItem::whereUserId($user->id)
                ->get()
                ->map(fn (CartItem $item) => [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);

        }else{
            return self::getCookieCartItems();
        }

    }


    public static function getCookieCartItems()
    {
        return json_decode(request()->cookie('cart_items','[]'), true);
    }

    public static function setCookieCartItems(array $cartItems)
    {
        Cookie::queue('cart_items',json_encode($cartItems), 60*24*30);
    }

    public static function saveCookieCartItems()
    {
        $user = auth()->user();
        $userCartItems = CartItem::where(['user_id'=> $user->id])->get()->keyBy('product_id');
        $savedCartItems = [];

        foreach (self::getCookieCartItems() as $cartItem)
        {
            if(isset($userCartItems[$cartItem['product_id']])){
                $userCartItems[$cartItem['product_id']]->update(['quantity'=> $cartItem['quantity']]);
                continue;
            }
            $userCartItems[] = [
                'user_id' => $user->id,
                'product_id'=> $cartItem['product_id'],
                'quantity'=> $cartItem['quantity'],
            ];
        }
        if(!empty($savedCartItems)){
            CartItem::insert($savedCartItems);
        }
    }

    public static function moveCartItemsIntoDb()
    {
        $request = request();
        $cartItems = self::getCookieCartItems();
        $newCartItems = [];

        foreach ($cartItems as $cartItem){
            //check if the record exist in the db
            $existingCatItem = CartItem::where([
                'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
            ])->first();

            if(!$existingCatItem) {

                $newCartItems[] = [
                   'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity']
                ];
            }
        }

        if(!empty($newCartItems)) {
            CartItem::insert($newCartItems);
        }
    }

    public static function getProductsAndCartItems()
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::whereIn('id',$ids)->with('product_images')->get();
        $cartItems = Arr::keyBy($cartItems,'product_id');
        return [$products,$cartItems];
    }
}