<?php

namespace App\Observers;

use App\Models\Cart;

class CartObserver
{
    /**
     * Handle the Cart "created" event.
     */
    public function created(Cart $cart): void
    {
        $this->fillCache($cart);
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        $this->fillCache($cart);
    }

    public function fillCache(Cart $cart): void
    {
        $changed = false;
        if ($customer = $cart->customer) {
            $changed = true;
            $cart->cache = array_merge($cart->cache, [
                'customer' => $customer->only([
                    'mobile',
                    'firstname',
                    'lastname',
                    'avatar',
                    'gender',
                    'status',
                ])
            ]);
        }
        if ($address = $cart->address) {
            $changed = true;
            $cart->cache = array_merge($cart->cache, [
                'address' => $address->only([
                    'latitude',
                    'longitude',
                    'detail',
                    'postcode',
                    'plate',
                    'floor',
                    'unit',
                    'province',
                    'city',
                ])
            ]);
        }
        if ($delivery = $cart->delivery) {
            $changed = true;
            $cart->cache = array_merge($cart->cache, [
                'deliver' => $delivery->only([
                    'name',
                    'driver',
                    'price',
                ])
            ]);
        }
        if ($changed) {
            $cart->save();
        }
    }
}
