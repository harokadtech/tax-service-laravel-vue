<?php


namespace App\Http\Service;


use App\EloquentQueries\EloquentTaxDataQueries;
use App\Helpers\CalculateTax;
use App\TaxData;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;

class InvoiceService
{
    private $eloquentTaxDataQueries;

    public function __construct(EloquentTaxDataQueries $eloquentTaxDataQueries)
    {
        $this->eloquentTaxDataQueries = $eloquentTaxDataQueries;
    }

    public function makeDataForPDF($id)
    {
        $generatedTo = Auth::user()->name;

        $taxData = $this->eloquentTaxDataQueries->getTaxData($id);
        $estimatedTax = CalculateTax::estimatedTax($taxData->tax_rate, $taxData->income);
        $totalCharge = CalculateTax::totalCharge($estimatedTax, $taxData->deductions, $taxData->paid);

        $taxData->estimated_tax = $estimatedTax;
        $taxData->total_charge = $totalCharge;
        $taxData->generated_to = $generatedTo;

       return $taxData;
    }
}
