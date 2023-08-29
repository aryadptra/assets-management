<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommodityCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get the commodities for the category.
     */

    public function commodities()
    {
        return $this->hasMany(Commodity::class);
    }
}
