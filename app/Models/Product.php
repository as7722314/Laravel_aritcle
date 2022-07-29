<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $tables = "products";

    protected $fillable = [
        'name',
        'min_price',
        'max_price',
        'index',
        'img'
    ];

    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value, 'Asia/Taipei')->timezone('Asia/Taipei')->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value, 'Asia/Taipei')->timezone('Asia/Taipei')->format('Y-m-d H:i:s');
        }
    }

    public function getDeletedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value, 'Asia/Taipei')->timezone('Asia/Taipei')->format('Y-m-d H:i:s');
        }
    }
}
