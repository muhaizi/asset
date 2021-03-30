<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ministry extends Model
{
    use HasFactory;

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function aset(){
        return $this->belongsTo(Asset::class);
    }

    public function scopeByRole($query, $user) //local scope
    {
        if($user->hasRole('KAD')){
            return $query->where('id', $user->ministry_id);
        }

    }
}
