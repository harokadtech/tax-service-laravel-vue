<?php

namespace App\Http\Controllers;

use App\Http\Service\InvoiceService;
use App\Mail\StatementEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Http\Request;

class MailController extends Controller
{
    private $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    public function sendMail($id)
    {
        $taxData = $this->invoiceService->makeDataForPDF($id);

        $pdf = PDF::loadView('pdf.invoice', compact('taxData'));

        Mail::to(Auth::user()->email)->send(new StatementEmail($taxData, $pdf));

        return redirect()->back()->with('success', 'We have sent this statement on your email! Check it out');;
    }
}
