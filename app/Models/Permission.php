<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function base_folders_accesses()
    {
        return $this->hasMany(BaseFolderAccess::class);
    }
}
