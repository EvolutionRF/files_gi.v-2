<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseFolder extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'owner_id', 'isPrivate', 'slug'];

    public function base_folders_accesses()
    {
        return $this->hasMany(BaseFolderAccess::class, 'basefolder_id', 'id');
    }
    public function contents()
    {
        return $this->morphMany('App\Models\Content', 'contentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function getGetDateAttribute()
    {
        return date('d-M-Y', strtotime($this->created_at));
    }
}
