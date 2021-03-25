<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = []; //inverse fillable

    //protected $with = ['map'];
    //relationship 1:1, 1:M, M:M
    public function ministry()
    {
        return $this->hasOne(Ministry::class, 'id', 'ministry_id')->withDefault(['name' => 'Tiada Kementerian']);
    }
    public function premise()
    {
        return $this->hasOne(Premise::class, 'id', 'premise_id')->withDefault(['name' => 'Tiada Premis']);
    }
    public function map()
    {
        return $this->hasOne(AssetMap::class, 'asset_id', 'id')->withDefault(['name' => 'Tiada Map']);
    }

    public function setDeadlineAttribute($value)//accessors && mutator
    {
        $this->attributes['deadline'] = empty($value) ? null : Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDeadlineAttribute($value)
    {
        return is_null($value) || empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
    }
}
