<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $fillable = ['name', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function getTasksByUser($user_id)
    {
        return self::where('user_id','=',$user_id)->orderBy('created_at','ask')->get();
    }
}
