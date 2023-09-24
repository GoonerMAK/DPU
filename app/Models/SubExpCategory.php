<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubExpCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_exp_cat';
    protected $primaryKey = 'cat_code';
    public $incrementing = false;
    public $timestamps = false;
}
