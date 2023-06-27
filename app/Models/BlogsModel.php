<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsModel extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    protected $guarded = [];
    public $timestamps = true;
}