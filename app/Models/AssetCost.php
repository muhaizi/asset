<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCost extends Model
{
    use HasFactory;

    protected $touches = ['asset']; //Touching Parent Timestamps


   
}
