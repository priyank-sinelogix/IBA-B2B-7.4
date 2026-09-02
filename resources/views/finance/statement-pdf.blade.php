<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #1a1a1a; }
        h1 { font-size: 20px; margin-bottom: 2px; }
        .muted { color: #777; }
        .header { border-bottom: 2px solid #0f2a4a; padding-bottom: 10px; margin-bottom: 16px; }
        .summary { width: 100%; margin-bottom: 16px; }
        .summary td { padding: 6px 10px; border: 1px solid #ddd; }
        .summary .label { color: #777; font-size: 10px; text-transform: uppercase; }
        .summary .value { font-size: 14px; font-weight: bold; color: #0f2a4a; }
        table.entries { width: 100%; border-collapse: collapse; }
        table.entries th, table.entries td { border: 1px solid #ddd; padding: 5px 7px; font-size: 11px; text-align: left; }
        table.entries th { background: #f2f4f7; }
        .text-right { text-align: right; }
        .text-capitalize { text-transform: capitalize; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sewgo — Account Statement</h1>
        <div class="muted">{{ $company->name }} ({{ $company->code }})</div>
        <div class="muted">Generated {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="label">Current Balance</div>
                <div class="value">{{ \App\Support\Currency::display($company->current_balance, $company->currency) }}</div>
            </td>
            <td>
                <div class="label">Credit Limit</div>
                <div class="value">{{ \App\Support\Currency::display($company->credit_limit, $company->currency) }}</div>
            </td>
            <td>
                <div class="label">Currency</div>
                <div class="value">{{ $company->currency->code ?? 'N/A' }}</div>
            </td>
        </tr>
    </table>

    <table class="entries">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Reference</th>
                <th>Description</th>
                <th class="text-right">Amount</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
        @forelse($ledgerEntries as $entry)
            <tr>
                <td>{{ $entry->created_at->format('d M Y') }}</td>
                <td class="text-capitalize">{{ str_replace('_', ' ', $entry->type) }}</td>
                <td>{{ $entry->reference_no }}</td>
                <td>{{ $entry->description }}</td>
                <td class="text-right">{{ \App\Support\Currency::display($entry->amount, $company->currency) }}</td>
                <td class="text-right">{{ \App\Support\Currency::display($entry->balance_after, $company->currency) }}</td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center; color:#777;">No ledger entries found.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
