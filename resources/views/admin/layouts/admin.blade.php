<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | IBA Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css">
    <style>
        :root{ --iba-navy:#0f2a4a; --iba-teal:#0fb98a; }
        table.table thead th{ position:relative; }
        table.table thead th:not(.no-sort){ cursor:pointer; user-select:none; }
        table.table thead th:not(.no-sort):hover{ background:#f2f4f7; }
        table.table thead th[data-sort-dir="asc"]::after{ content:' \25B2'; font-size:.7em; }
        table.table thead th[data-sort-dir="desc"]::after{ content:' \25BC'; font-size:.7em; }
        /* Select2 (AJAX search dropdowns) — match the plain Bootstrap .form-control look/height used by every other field */
        .select2-container{ width:100% !important; }
        .select2-container--bootstrap4 .select2-selection--single{
            height: calc(2.25rem + 2px);
            border: 1px solid #ced4da;
            border-radius: .25rem;
            display: flex;
            align-items: center;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered{
            padding-left: .75rem;
            padding-right: 1.5rem;
            line-height: 1.5;
            color: #495057;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder{
            color: #6c757d;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow{
            height: calc(2.25rem + 2px);
            right: .5rem;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__clear{
            margin-right: 1.25rem;
        }
        .select2-container--bootstrap4.select2-container--focus .select2-selection,
        .select2-container--bootstrap4.select2-container--open .select2-selection{
            border-color: var(--iba-teal);
            box-shadow: 0 0 0 .2rem rgba(15,185,138,.15);
        }
        .select2-dropdown{
            border-color: #ced4da;
            border-radius: .25rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            z-index: 1060;
        }
        .select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected]{
            background-color: var(--iba-teal);
        }
        .select2-search--dropdown .select2-search__field{
            border: 1px solid #ced4da;
            border-radius: .25rem;
            padding: .375rem .5rem;
        }
        .select2-search--dropdown .select2-search__field:focus{
            outline: none;
            border-color: var(--iba-teal);
        }
        /* Plain <select class="form-control"> filters (per-page, status, etc.) — these had no
           styling at all and looked like a bare native dropdown next to the Select2 fields
           above. Custom arrow + matching teal focus ring so every field looks like one family. */
        select.form-control{
            appearance: none; -webkit-appearance: none; -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right .65rem center;
            background-size: 14px 14px;
            padding-right: 2rem !important;
        }
        .form-control:focus{
            border-color: var(--iba-teal);
            box-shadow: 0 0 0 .2rem rgba(15,185,138,.15);
        }
        .brand-link{ background:var(--iba-navy); border-bottom:1px solid rgba(255,255,255,.1); }
        .brand-text{ color:#fff; font-weight:800; letter-spacing:.5px; }
        .main-sidebar{ background:var(--iba-navy); }
        .nav-sidebar .nav-link{ color:#c7d2e0; border-radius:8px; margin-bottom:2px; }
        .nav-sidebar .nav-link.active{ background:var(--iba-teal); color:#fff; font-weight:600; }
        .nav-sidebar .nav-link:hover{ color:#fff; }
        .card{ border-radius:14px; border:1px solid #eef0f2; box-shadow:0 1px 4px rgba(0,0,0,.04); }
        .card-header{ border-radius:14px 14px 0 0 !important; background:#fff; }
        .admin-pill{ background:#eaf6ff; color:var(--iba-navy); font-size:.7rem; padding:2px 10px; border-radius:20px; font-weight:700; letter-spacing:.5px; }
        .badge-pending{ background:#fff3cd; color:#8a6d00; }
        .badge-approved{ background:#d7f7ea; color:#0a7a52; }
        .badge-changes{ background:#ffe3d9; color:#b34700; }
        .admin-toast{
            position: fixed; top: 20px; right: 20px; z-index: 2000;
            max-width: min(360px, calc(100vw - 40px)); word-wrap: break-word;
            background: var(--iba-teal); color: #fff; padding: 12px 20px; border-radius: 8px;
            box-shadow: 0 4px 14px rgba(0,0,0,.15); font-weight: 600; font-size: .9rem;
            animation: adminToastIn .25s ease-out;
        }
        @keyframes adminToastIn{ from{ opacity:0; transform: translateY(-10px); } to{ opacity:1; transform: translateY(0); } }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><span class="admin-pill">INTERNAL ADMIN PANEL</span></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle mr-1"></i> {{ auth()->user()->name ?? 'Staff' }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <form method="POST" action="{{ url('/admin/logout') }}">@csrf
                        <button class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-1">
        <a href="{{ url('/admin/dashboard') }}" class="brand-link">
            <span class="brand-text">IBA <small class="d-block text-white-50" style="font-size:.6rem;letter-spacing:2px;">ADMIN PANEL</small></span>
        </a>
        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/companies') }}" class="nav-link {{ request()->is('admin/companies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i><p>Client Companies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/sample-requests') }}" class="nav-link {{ request()->is('admin/sample-requests*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plus-circle"></i><p>Sample Requests</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/samples') }}" class="nav-link {{ request()->is('admin/samples*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tshirt"></i><p>Samples</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/skus') }}" class="nav-link {{ request()->is('admin/skus*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i><p>SKUs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/pricing') }}" class="nav-link {{ request()->is('admin/pricing*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i><p>Pricing</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/orders') }}" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i><p>Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/shipments') }}" class="nav-link {{ request()->is('admin/shipments*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i><p>Shipments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/finance') }}" class="nav-link {{ request()->is('admin/finance*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dollar-sign"></i><p>Finance / Ledger</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/messages') }}" class="nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-comment-dots"></i><p>Messages
                                @php
                                    $unreadMessageCount = \App\Models\Message::where('is_read', false)
                                        ->whereHas('sender', function ($q) { $q->where('role', 'customer'); })
                                        ->count();
                                @endphp
                                @if($unreadMessageCount > 0)
                                    <span class="badge badge-danger right">{{ $unreadMessageCount }}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/currencies') }}" class="nav-link {{ request()->is('admin/currencies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-coins"></i><p>Currencies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i><p>Staff & Client Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/audit-logs') }}" class="nav-link {{ request()->is('admin/audit-logs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i><p>Audit Logs</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper" style="background:#f7f8fa;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"><div class="col-sm-6"><h1 class="m-0">@yield('title')</h1></div></div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div id="successToast" class="admin-toast"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer"><strong>&copy; {{ date('Y') }} IBA Just In Time Garments.</strong> Internal Admin Panel</footer>
</div>

@include('partials.image-lightbox')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ asset('js/admin/table-sort.js') }}"></script>
<script>
    // Reusable AJAX-backed searchable dropdown (Select2), used on any <select>
    // whose full option list could grow large (companies, samples, orders).
    function ibaAjaxSelect2(el, type, opts) {
        opts = opts || {};
        $(el).select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: opts.placeholder || 'Type to search...',
            allowClear: !!opts.allowClear,
            minimumInputLength: 0,
            ajax: {
                url: '{{ url('/admin/ajax/search') }}/' + type,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term || '',
                        page: params.page || 1,
                        approved_only: opts.approvedOnly ? 1 : 0
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return { results: data.results, pagination: data.pagination };
                },
                cache: true
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('successToast');
        if (!toastEl) return;
        setTimeout(function () {
            toastEl.style.transition = 'opacity .3s ease';
            toastEl.style.opacity = '0';
            setTimeout(function () { toastEl.remove(); }, 300);
        }, 3000);
    });
</script>
@stack('scripts')
</body>
</html>
