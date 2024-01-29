<?php

namespace App\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'product_type_id', 'valid_from', 'valid_to', 'status', 'activatedBy'];

    public function Variant(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function ProductType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
