<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Page size for a list, from the ?per_page= query param — restricted to
     * a fixed set of options so it can't be abused to pull the whole table.
     */
    protected function perPage(Request $request, int $default = 100): int
    {
        $allowed = [15, 25, 50, 100, 200];
        $requested = (int) $request->get('per_page', $default);

        return in_array($requested, $allowed, true) ? $requested : $default;
    }
}
