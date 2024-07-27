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
        $this->fillDetails($cart);
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        $this->fillDetails($cart);
    }

    public function fillDetails(Cart $cart): void
    {
        $cart->details = data_get($cart->load($cart->detailFields)->toArray(), $cart->detailFields);
        $cart->save();
    }
}
