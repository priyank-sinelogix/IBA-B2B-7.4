<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generate(Sample $sample)
    {
        $sample->load(['company.currency', 'latestVersion', 'sizeChartRows', 'comments.user', 'skus', 'pricings']);

        // Images must be embedded as local file paths (or base64) for dompdf — public URLs
        // over http(s) won't render reliably, so we resolve the actual disk path here.
        $imagePath = null;
        if ($sample->latestVersion) {
            $fullPath = storage_path('app/public/'.$sample->latestVersion->image_path);
            if (file_exists($fullPath)) {
                $imagePath = $fullPath;
            }
        }

        $pdf = Pdf::loadView('admin.samples.pdf', compact('sample', 'imagePath'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream($sample->sample_code.'-spec-sheet.pdf');
        // Use ->download(...) instead of ->stream(...) to force a save dialog rather than opening in-browser.
    }
}
