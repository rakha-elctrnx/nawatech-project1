<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'spec', 'name', 'value'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
