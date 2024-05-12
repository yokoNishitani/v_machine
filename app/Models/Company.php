<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getCompanyList() {
        $companies = DB::table('companies')->get();
        return $companies;
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
