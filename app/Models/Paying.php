<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paying extends Model
{
    use HasFactory;
    protected $table = 'payings';

    protected $fillable = [
        'name',
        'account_number',
        'logo',
    ];
}
