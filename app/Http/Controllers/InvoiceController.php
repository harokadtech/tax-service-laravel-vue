<?php

namespace App\Http\Controllers;

use App\Resident;
use App\TaxData;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download($taxData)
    {
////        $test = TaxData::find(2);
////        dd($test->resident);
////        dd($taxData);
//        $requestId = (Resident::where('tax_data_id', $taxData)->first());
//        dd($requestId);
        $generatedTo = Auth::user()->name;
        $taxData = TaxData::findOrFail($taxData);
        $estimatedTax = $taxData->tax_rate/100 * $taxData->income;
        $totalCharge = $estimatedTax - $taxData->deductions - $taxData->paid;
        $taxData->estimated_tax = $estimatedTax;
        $taxData->total_charge = $totalCharge;
        $taxData->generated_to = $generatedTo;
//        $taxData->request_id = $requestId;

        $pdf = PDF::loadView('pdf.invoice', compact('taxData'));

        return $pdf->download('invoice.pdf');
    }
}
