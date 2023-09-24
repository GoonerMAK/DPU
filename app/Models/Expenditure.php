<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $table = 'expenditure';
    protected $primaryKey = 'exp_code';
    public $incrementing = false;
    public $timestamps = false;
}
