<?php

namespace App\Support;

class Currency
{
    /**
     * Formats a number in Indian numbering style: 1234567.89 -> "12,34,567.89"
     * Returns just the formatted number (no symbol) so it can be used in
     * form inputs as well as display text.
     */
    public static function format($amount, int $decimals = 2): string
    {
        $amount = (float) $amount;
        $negative = $amount < 0;
        $amount = abs($amount);

        $parts = explode('.', number_format($amount, $decimals, '.', ''));
        $whole = $parts[0];
        $decimal = $decimals > 0 ? '.'.$parts[1] : '';

        if (strlen($whole) <= 3) {
            $grouped = $whole;
        } else {
            $lastThree = substr($whole, -3);
            $rest = substr($whole, 0, -3);
            // Group the remaining digits in pairs of 2, from the right
            $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            $grouped = $rest.','.$lastThree;
        }

        return ($negative ? '-' : '').$grouped.$decimal;
    }

    /**
     * Same as format(), prefixed with the ₹ symbol — use this in views.
     */
    public static function inr($amount, int $decimals = 2): string
    {
        return '₹'.self::format($amount, $decimals);
    }
}
