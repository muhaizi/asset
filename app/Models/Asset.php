<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    //relationship 1:1, 1:M, M:M
    public function ministry()
    {
        return $this->hasOne(Ministry::class, 'id', 'ministry_id')->withDefault(['name' => 'Tiada Kementerian']);
    }
    public function premise()
    {
        return $this->hasOne(Premise::class, 'id', 'premise_id')->withDefault(['name' => 'Tiada Premis']);
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = empty($value) ? null : Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDeadlineAttribute($value)
    {
        return is_null($value) || empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
    }
}
