<?php

namespace App\Http\Controllers;

use App\Http\Service\InvoiceService;
use App\Resident;
use App\TaxData;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function download($id)
    {
        $taxData = $this->invoiceService->makeDataForPDF($id);

        $pdf = PDF::loadView('pdf.invoice', compact('taxData'));
        return $pdf->download('invoice.pdf');
    }
}
