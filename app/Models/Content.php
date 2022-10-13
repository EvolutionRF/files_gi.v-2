<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function contentable()
    {
        return $this->morphTo();
    }

    public function contents()
    {
        return $this->morphMany('App\Models\Content', 'contentable');
    }

    public function access()
    {
        return $this->hasMany(Access::class, 'content_id', 'id');
    }
}
