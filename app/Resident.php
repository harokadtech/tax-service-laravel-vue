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
        'sign'
        ];
}
