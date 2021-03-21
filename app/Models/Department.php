<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function scopeParentCode($query, $parent)
    {
        return $query->where('ministry_id', $parent);
    }

    public function scopeOrder($query, $field){
        return $query->orderBy($field);
    }
}
