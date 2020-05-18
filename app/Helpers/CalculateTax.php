<?php


namespace App\Helpers;


class CalculateTax
{
    public static function estimatedTax($taxRate, $income)
    {
        return $taxRate/100 * $income;
    }

    public static function totalCharge($estimatedTax, $deductions, $paid)
    {
        return $estimatedTax - $deductions - $paid;
    }
}
