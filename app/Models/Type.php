<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type_name', 'price', 'image'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function specs(): HasMany
    {
        return $this->hasMany(Specification::class);
    }
}
