<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = AuditLog::with(['company', 'user']);
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where('action', 'like', $term);
        }
        $logs = $query->latest('created_at')->paginate($this->perPage($request));
        return view('admin.audit-logs.index', compact('logs'));
    }
}
