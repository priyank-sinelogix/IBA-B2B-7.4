<?php

namespace App\Support;

use App\Models\Currency as CurrencyModel;

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

    /**
     * Formats an amount with the correct symbol and grouping style for a given
     * currency. $currency accepts a Currency model, a currency code string
     * (e.g. 'USD'), or null (falls back to INR so old call sites keep working).
     */
    public static function display($amount, $currency = null, int $decimals = 2): string
    {
        $code = 'INR';
        $symbol = '₹';

        if ($currency instanceof CurrencyModel) {
            $code = strtoupper($currency->code);
            $symbol = $currency->symbol;
        } elseif (is_string($currency) && $currency !== '') {
            $code = strtoupper($currency);
            $symbol = self::symbolFor($code);
        }

        if ($code === 'INR') {
            return $symbol.self::format($amount, $decimals);
        }

        $amount = (float) $amount;
        $negative = $amount < 0;

        return $symbol.($negative ? '-' : '').number_format(abs($amount), $decimals, '.', ',');
    }

    public static function symbolFor(string $code): string
    {
        $code = strtoupper($code);

        return [
            'INR' => '₹',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'AED' => 'د.إ',
            'AUD' => 'A$',
            'CAD' => 'C$',
        ][$code] ?? $code.' ';
    }

    /**
     * Converts an amount from one currency into another using each currency's
     * exchange_rate — both rates are stored relative to the same base currency
     * (see the `currencies` table, where the base row has exchange_rate = 1).
     */
    public static function convert(float $amount, CurrencyModel $from, CurrencyModel $to): float
    {
        if ($from->id === $to->id) {
            return round($amount, 2);
        }

        $amountInBase = $amount * (float) $from->exchange_rate;
        $toRate = (float) $to->exchange_rate;

        return $toRate > 0 ? round($amountInBase / $toRate, 2) : 0.0;
    }
}
