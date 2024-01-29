<?php

namespace App\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'product_id', 'price'];

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
