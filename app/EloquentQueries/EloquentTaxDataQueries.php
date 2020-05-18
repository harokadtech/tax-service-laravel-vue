<?php


namespace App\EloquentQueries;


use App\TaxData;

class EloquentTaxDataQueries
{
    public function getTaxData($id)
    {
        return TaxData::findOrFail($id);
    }
}
