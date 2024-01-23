<?php

namespace App\Order\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use FilterTrait;

    protected $table = 'orders';
    protected $fillable = ['amount', 'description', 'status'];
    protected $likeFilterFields = ['description'];
}
