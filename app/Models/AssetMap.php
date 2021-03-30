<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMap extends Model
{
    use HasFactory;

    protected $guarded = [];

    // when a Comment model is updated, you may want to automatically "touch" 
    // the updated_at timestamp of the owning Post so that it is set to the current date and time.
    protected $touches = ['asset'];


    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    
}
