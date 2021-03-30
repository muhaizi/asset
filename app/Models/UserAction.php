<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'action', 'action_model', 'action_id', 'original', 'current'];

    //https://laravel.com/docs/8.x/eloquent-mutators
    protected $casts = ['original' => 'array', 'current' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }   
}
