<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = "residents";

    protected $hidden = ['image', 'sign'];

    protected $fillable = [
        'email',
        'zip',
        'address',
        'image',
        'sign',
        'user_id',
        ];
    protected static function boot()
    {
        parent::boot();
        static::created(function($resident) {
            $resident->taxData()->create([
                'user_id'=>$resident->user_id,
                'income'=>mt_rand(9000,500000),
                'tax_rate'=>mt_rand(8,18),
                'deductions'=>mt_rand(0,100),
                'paid' =>mt_rand(0, 300),
            ]);

        });

    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function taxData()
    {
        return $this->hasOne('App\TaxData');
    }
}
