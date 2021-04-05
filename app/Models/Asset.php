<?php

namespace App\Models;

use App\Observers\AssetObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Asset extends Model
{
    use HasFactory, SoftDeletes, Sortable, HasEvents;

    protected $guarded = []; //inverse fillable
    protected $count = ['ministry_id'];
    //protected $with = []; always eager load , exclude $books = Book::without('author')->get();
    protected $appends = ['costs_sum_sumber'];

    public $sortableAs = ['costs_sum_sumber'];
    public $sortable = ['description', 'ministry_id', 'deadline'];
    protected $casts = ['deadline' => 'date'];

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
    public function maps()
    {
        return $this->hasOne(AssetMap::class, 'asset_id', 'id')->withDefault(['name' => 'Tiada Map']);
    }
    public function costs()
    {
        return $this->hasMany(AssetCost::class, 'asset_id', 'id');
    }

    public function setDeadlineAttribute($value)//accessors && mutator
    {
        $this->attributes['deadline'] = empty($value) ? null : Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDeadlineAttribute($value)
    {
        return is_null($value) || empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
    }

    public function getDescriptionAttribute($value)
    {
        return nl2br($value);
    }

    public function getCostsSumSumberAttribute($value)
    {
        return 'RM'.number_format($value,2);
    }

}
