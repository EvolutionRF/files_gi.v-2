<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentAccess extends Model
{
    use HasFactory;
    protected $table = 'accesses';
    protected $fillable = ['content_id', 'permission_id', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'id', 'permission_id');
    }
}
