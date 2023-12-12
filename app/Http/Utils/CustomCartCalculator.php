<?php

namespace App\Http\Utils;

use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Contracts\Calculator;

class CustomCartCalculator implements Calculator
{
    public static function getAttribute(string $attribute, CartItem $cartItem)
    {
        $decimals = config('cart.format.decimals', 2);

        switch ($attribute) {
            case 'discount':
                return $cartItem->price * ($cartItem->getDiscountRate() / 100);
            case 'tax': // Impuesto
                return round($cartItem->priceTarget - ($cartItem->priceTarget / (1 + ($cartItem->taxRate / 100))), $decimals);
            case 'priceTax': // Precio + Impuesto (En caso de GT va incluido así que no se suma)
                return round($cartItem->priceTarget * $cartItem->qty, $decimals);
            case 'discountTotal':
                return round($cartItem->discount * $cartItem->qty, $decimals);
            case 'priceTotal':
                return round($cartItem->price * $cartItem->qty, $decimals);
            case 'subtotal':
                return max(round($cartItem->priceTotal - $cartItem->discountTotal, $decimals), 0);
            case 'priceTarget':
                return round(($cartItem->priceTotal - $cartItem->discountTotal) / $cartItem->qty, $decimals);
            case 'taxTotal':
                return round(($cartItem->subtotal / (1 + ($cartItem->taxRate / 100))) * ($cartItem->taxRate / 100), $decimals);
            case 'total': // Precio final (No se suma el IVA en GT)
                return round($cartItem->subtotal, $decimals);
            default:
                return;
        }
    }
}
