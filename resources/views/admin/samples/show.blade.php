@extends('admin.layouts.admin')
@section('title', $sample->sample_code)

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Current Image</h3>
                <div>
                    <a href="{{ url('/admin/samples/'.$sample->id.'/pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-file-pdf mr-1"></i> PDF</a>
                    <a href="{{ url('/admin/samples/'.$sample->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
            </div>
            <div class="card-body text-center">
                <img src="{{ optional($sample->latestVersion)->signedImageUrl() ?? 'https://via.placeholder.com/300' }}"
                     class="img-fluid rounded mb-3" style="max-height:300px;object-fit:cover;">
                @if($sample->latestVersion && $sample->latestVersion->images->count() > 1)
                <div class="mb-3">
                    @foreach($sample->latestVersion->images as $img)
                        <a href="{{ $img->url() }}" target="_blank">
                            <img src="{{ $img->url() }}" width="56" height="56" style="object-fit:cover;border-radius:6px;" class="mr-1 mb-1 border">
                        </a>
                    @endforeach
                </div>
                @endif
                <h5 class="mb-1">{{ $sample->style_name }}</h5>
                <p class="text-muted mb-0">Code: {{ $sample->sample_code }}</p>
                <p class="text-muted mb-0">Fabric: {{ $sample->fabric }}</p>
                <p class="text-muted">Color: {{ $sample->color }}</p>
                <p>
                    @if($sample->status == 'pending') <span class="badge badge-pending">Pending</span>
                    @elseif($sample->status == 'approved') <span class="badge badge-approved">Approved</span>
                    @else <span class="badge badge-changes">Changes Requested</span> @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Client Company</h3>
                <a href="{{ url('/admin/companies/'.$sample->company->id) }}" class="btn btn-sm btn-outline-secondary">View Company</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7">{{ $sample->company->name }}</dd>
                    <dt class="col-5">Code</dt><dd class="col-7">{{ $sample->company->code }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Version History</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($sample->versions as $version)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ $version->signedImageUrl() }}" width="40" height="40" style="object-fit:cover;border-radius:6px;" class="mr-3">
                        <div>
                            <div class="font-weight-bold small">Version {{ $version->version_no }} ({{ $version->images->count() }} image{{ $version->images->count() == 1 ? '' : 's' }})</div>
                            <div class="text-muted small">{{ $version->notes }}</div>
                        </div>
                        <span class="text-muted small ml-auto">{{ $version->created_at->format('d M Y') }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center">No versions yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Comments & Approval History</h3></div>
            <div class="card-body" style="max-height:480px;overflow-y:auto;">
                @forelse($sample->comments as $comment)
                <div class="d-flex mb-3 {{ $comment->action == 'revise' ? 'p-2' : '' }}" style="{{ $comment->action == 'revise' ? 'background:#fff5f2;border-radius:8px;' : '' }}">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;flex-shrink:0;">
                        {{ substr($comment->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <div class="font-weight-bold small">
                            {{ $comment->user->name ?? 'User' }}
                            @if($comment->user && $comment->user->isAdmin())
                                <span class="badge badge-light border ml-1">IBA Team</span>
                            @endif
                            @if($comment->action == 'approve') <span class="badge badge-approved ml-1">Approved</span>
                            @elseif($comment->action == 'revise') <span class="badge badge-changes ml-1">Requested Revision</span>
                            @endif
                        </div>
                        <div class="text-muted small">{{ $comment->comment }}</div>
                        <div class="text-muted" style="font-size:.75rem;">{{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center">No comments yet.</p>
                @endforelse
            </div>

            <!-- Admin adds their own point/reply here, same thread the client sees -->
            <div class="card-footer">
                <form method="POST" action="{{ url('/admin/samples/'.$sample->id.'/comment') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <textarea name="comment" class="form-control" rows="2" placeholder="Add a note or reply to the client's feedback..." required></textarea>
                    </div>
                    <button class="btn btn-sm btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Size Chart -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Size Chart
                    @if($sample->size_chart_status == 'approved')
                        <span class="badge badge-approved ml-2">Client Approved</span>
                    @else
                        <span class="badge badge-pending ml-2">Pending Client Approval</span>
                    @endif
                </h3>
                <div>
                    <a href="{{ asset('templates/size-chart-sample.csv') }}" class="btn btn-sm btn-outline-secondary" download><i class="fas fa-download mr-1"></i> Sample CSV</a>
                    <form action="{{ url('/admin/samples/'.$sample->id.'/size-chart/import-csv') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;" id="sizeChartCsvForm">
                        @csrf
                        <input type="file" name="csv_file" accept=".csv,text/csv" id="sizeChartCsvInput" style="display:none;" onchange="document.getElementById('sizeChartCsvForm').submit();">
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="document.getElementById('sizeChartCsvInput').click();"><i class="fas fa-file-csv mr-1"></i> Upload CSV</button>
                    </form>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSizeChartRow()"><i class="fas fa-plus mr-1"></i> Add Row</button>
                </div>
            </div>
            <form method="POST" action="{{ url('/admin/samples/'.$sample->id.'/size-chart') }}">
                @csrf
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="sizeChartTable">
                        <thead>
                            <tr>
                                <th style="min-width:180px;">Specifications</th>
                                <th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th><th>5XL</th><th></th>
                            </tr>
                        </thead>
                        <tbody id="sizeChartBody">
                        @forelse($sample->sizeChartRows as $row)
                            <tr>
                                <td><input type="text" name="specification[]" class="form-control form-control-sm" value="{{ $row->specification }}"></td>
                                <td><input type="number" step="0.01" name="xs[]" class="form-control form-control-sm" value="{{ $row->xs }}"></td>
                                <td><input type="number" step="0.01" name="s[]" class="form-control form-control-sm" value="{{ $row->s }}"></td>
                                <td><input type="number" step="0.01" name="m[]" class="form-control form-control-sm" value="{{ $row->m }}"></td>
                                <td><input type="number" step="0.01" name="l[]" class="form-control form-control-sm" value="{{ $row->l }}"></td>
                                <td><input type="number" step="0.01" name="xl[]" class="form-control form-control-sm" value="{{ $row->xl }}"></td>
                                <td><input type="number" step="0.01" name="xxl[]" class="form-control form-control-sm" value="{{ $row->xxl }}"></td>
                                <td><input type="number" step="0.01" name="xxxl[]" class="form-control form-control-sm" value="{{ $row->xxxl }}"></td>
                                <td><input type="number" step="0.01" name="xxxxl[]" class="form-control form-control-sm" value="{{ $row->xxxxl }}"></td>
                                <td><input type="number" step="0.01" name="xxxxxl[]" class="form-control form-control-sm" value="{{ $row->xxxxxl }}"></td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">&times;</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td><input type="text" name="specification[]" class="form-control form-control-sm" placeholder="e.g. Chest Width"></td>
                                <td><input type="number" step="0.01" name="xs[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="s[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="m[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="l[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="xl[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="xxl[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="xxxl[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="xxxxl[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="xxxxxl[]" class="form-control form-control-sm"></td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">&times;</button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Save Size Chart</button>
                    <span class="text-muted small ml-2">Saving re-opens it for client approval.</span>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SKUs -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">SKUs</h3>
                <a href="{{ url('/admin/skus/create?sample_id='.$sample->id) }}" class="btn btn-sm btn-outline-primary">Generate SKUs</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>SKU Code</th><th>Fabric</th><th>Colour</th><th>Size</th></tr></thead>
                    <tbody>
                    @forelse($sample->skus as $sku)
                        <tr><td>{{ $sku->sku_code }}</td><td>{{ $sku->fabric }}</td><td>{{ $sku->colour }}</td><td>{{ $sku->size }}</td></tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No SKUs generated yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pricing -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Pricing</h3>
                <a href="{{ url('/admin/pricing/create?sample_id='.$sample->id) }}" class="btn btn-sm btn-outline-primary">Add Pricing</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Style</th><th class="text-right">COGP</th><th class="text-right">Price</th></tr></thead>
                    <tbody>
                    @forelse($sample->pricings as $p)
                        <tr><td>{{ $p->style }}</td><td class="text-right">{{ \App\Support\Currency::display($p->cogp, $sample->company->currency) }}</td><td class="text-right">{{ \App\Support\Currency::display($p->price_usd, $sample->company->currency) }}</td></tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted p-3">No pricing entries yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function addSizeChartRow() {
        var tbody = document.getElementById('sizeChartBody');
        var row = document.createElement('tr');
        var cols = ['specification', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl'];
        cols.forEach(function (name, i) {
            var td = document.createElement('td');
            var input = document.createElement('input');
            input.className = 'form-control form-control-sm';
            input.name = name + '[]';
            input.type = i === 0 ? 'text' : 'number';
            if (i > 0) input.step = '0.01';
            td.appendChild(input);
            row.appendChild(td);
        });
        var actionTd = document.createElement('td');
        actionTd.innerHTML = '<button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest(\'tr\').remove()">&times;</button>';
        row.appendChild(actionTd);
        tbody.appendChild(row);
    }
</script>
@endsection
