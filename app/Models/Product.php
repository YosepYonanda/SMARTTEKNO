<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
//insert product
    protected $fillable = [
        'name', 'type', 'description', 'price', 'quantity', 'slug'
    ];
//delete product
    protected $dates = ['deleted_at'];
}
