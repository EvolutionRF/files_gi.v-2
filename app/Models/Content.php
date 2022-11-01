<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Content extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['name', 'isPrivate'];

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
        return $this->hasMany(ContentAccess::class, 'content_id', 'id');
    }

    public function deleteWithInnerFolder()
    {
        if (count($this->contents) > 0) {
            // Delete children recursive
            foreach ($this->contents as $content) {
                $content->deleteWithInnerFolder();
            }
        }
        $this->delete();
    }
}
