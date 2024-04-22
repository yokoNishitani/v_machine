<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    // use HasFactory;
    public function getProductRegist()
    {
        $products = Product::with(['company'])->get();
        return view('product_regist')->with('products', $products);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
