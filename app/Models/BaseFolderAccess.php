<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class BaseFolderAccess extends Model
{
    protected $table = 'base_folders_accesses';
    protected $fillable = ['basefolder_id', 'permission_id', 'user_id'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function basefolder()
    {
        return $this->belongsTo(BaseFolder::class);
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
