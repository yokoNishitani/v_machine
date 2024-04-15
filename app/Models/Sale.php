<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Product;

class Sale extends Model
{
    // use HasFactory;
    public function getSaleList() {
        $sales = DB::table('sales')->get();
        return $sales;
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
