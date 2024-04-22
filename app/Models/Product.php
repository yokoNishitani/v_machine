<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    // use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'img_url',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
