<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrderModel extends Model
{
    use HasFactory;
    protected $table = 'detailorder';

    protected $guarded = [];
    public $timestamps = true;
}
