<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Applied to the whole customer web portal (see routes/web.php).
 * Guarantees every authenticated customer user has a company_id,
 * and makes it available to controllers without re-checking each time.
 */
class EnsureCustomerScope
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isCustomer() || ! $user->company_id) {
            auth()->logout();

            return redirect('/login')->withErrors(['email' => 'Please log in to continue.']);
        }

        if (! $user->company->is_active) {
            auth()->logout();

            return redirect('/login')->withErrors(['email' => 'Your company account has been suspended. Please contact IBA support.']);
        }

        // Available in controllers via $request->attributes->get('company_id')
        $request->attributes->set('company_id', $user->company_id);

        return $next($request);
    }
}
