<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'name', 'image', 'audio', 'detail'];
    
    //1対多のリレーション追加
    public function user() {
        return $this->belongsTo(User::class);
    }
}
