<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxData extends Model
{
    protected $table = "tax_data";

    protected $fillable = [
        'user_id',
        'income',
        'tax_rate',
        'deductions',
        'paid'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }
}
