<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #1a1a1a; }
        h1 { font-size: 20px; margin-bottom: 2px; }
        .muted { color: #777; }
        .header { border-bottom: 2px solid #0f2a4a; padding-bottom: 10px; margin-bottom: 16px; }
        .section-title { font-size: 14px; font-weight: bold; color: #0f2a4a; margin-top: 20px; margin-bottom: 8px; border-bottom: 1px solid #ddd; padding-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #ddd; padding: 5px 7px; font-size: 11px; text-align: left; }
        th { background: #f2f4f7; }
        .text-right { text-align: right; }
        .image-box { text-align: center; margin-bottom: 10px; }
        .image-box img { max-height: 260px; max-width: 100%; border: 1px solid #ddd; }
        .comment { border-bottom: 1px solid #eee; padding: 6px 0; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .badge-approved { background: #d7f7ea; color: #0a7a52; }
        .badge-pending { background: #fff3cd; color: #8a6d00; }
    </style>
</head>
<body>
    <div class="header">
        <h1>IBA Just In Time Garments — Product Spec Sheet</h1>
        <div class="muted">{{ $sample->sample_code }} — {{ $sample->style_name }} — {{ $sample->company->name }}</div>
        <div class="muted">Generated {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    @if($imagePath)
    <div class="image-box">
        <img src="{{ $imagePath }}">
    </div>
    @endif

    <div class="section-title">Product Details</div>
    <table>
        <tr><th style="width:30%;">Sample Code</th><td>{{ $sample->sample_code }}</td></tr>
        <tr><th>Style Name</th><td>{{ $sample->style_name }}</td></tr>
        <tr><th>Fabric</th><td>{{ $sample->fabric }}</td></tr>
        <tr><th>Colour</th><td>{{ $sample->color }}</td></tr>
        <tr><th>Status</th><td>{{ ucwords(str_replace('_',' ',$sample->status)) }}</td></tr>
    </table>

    @if($sample->skus->count())
    <div class="section-title">SKUs</div>
    <table>
        <thead><tr><th>SKU Code</th><th>Fabric</th><th>Print</th><th>Colour</th><th>Size</th></tr></thead>
        <tbody>
        @foreach($sample->skus as $sku)
            <tr><td>{{ $sku->sku_code }}</td><td>{{ $sku->fabric }}</td><td>{{ $sku->print }}</td><td>{{ $sku->colour }}</td><td>{{ $sku->size }}</td></tr>
        @endforeach
        </tbody>
    </table>
    @endif

    @if($sample->sizeChartRows->count())
    <div class="section-title">Size Chart — Approval Status:
        @if($sample->size_chart_status == 'approved') <span class="badge badge-approved">Approved</span>
        @else <span class="badge badge-pending">Pending</span> @endif
    </div>
    <table>
        <thead>
            <tr><th>Specification</th><th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th><th>5XL</th></tr>
        </thead>
        <tbody>
        @foreach($sample->sizeChartRows as $row)
            <tr>
                <td>{{ $row->specification }}</td>
                <td>{{ $row->xs }}</td><td>{{ $row->s }}</td><td>{{ $row->m }}</td><td>{{ $row->l }}</td>
                <td>{{ $row->xl }}</td><td>{{ $row->xxl }}</td><td>{{ $row->xxxl }}</td><td>{{ $row->xxxxl }}</td><td>{{ $row->xxxxxl }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

    @if($sample->pricings->count())
    <div class="section-title">Pricing</div>
    <table>
        <thead>
            <tr><th>Style</th><th>Fabric</th><th class="text-right">Fabric Cost + Accessories</th><th class="text-right">Stitching Cost</th><th class="text-right">COGP</th><th class="text-right">Margin</th><th class="text-right">Price (₹)</th></tr>
        </thead>
        <tbody>
        @foreach($sample->pricings as $p)
            <tr>
                <td>{{ $p->style }}</td><td>{{ $p->fabric }}</td>
                <td class="text-right">₹{{ \App\Support\Currency::format($p->fabric_cost) }}</td>
                <td class="text-right">₹{{ \App\Support\Currency::format($p->stitching_cost) }}</td>
                <td class="text-right">₹{{ \App\Support\Currency::format($p->cogp) }}</td>
                <td class="text-right">₹{{ \App\Support\Currency::format($p->margin) }}</td>
                <td class="text-right">₹{{ \App\Support\Currency::format($p->price_usd) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

    @if($sample->comments->count())
    <div class="section-title">Comments & Approval History</div>
    @foreach($sample->comments as $comment)
        <div class="comment">
            <strong>{{ $comment->user->name ?? 'User' }}</strong>
            <span class="muted">— {{ $comment->created_at->format('d M Y, h:i A') }}</span>
            @if($comment->action == 'approve') <span class="badge badge-approved">Approved</span>
            @elseif($comment->action == 'revise') <span class="badge badge-pending">Revision Requested</span>
            @endif
            <div>{{ $comment->comment }}</div>
        </div>
    @endforeach
    @endif
</body>
</html>
