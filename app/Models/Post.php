<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Prunable;
    protected $fillable =[
        'title',
        'description',
        'user_id',
        'delTime',
    ];
    public function prunable()
    {
        return static::query()->where('deleted_at','<=', now()->subHour(3));
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
