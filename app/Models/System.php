<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use SoftDeletes;

    protected $table = 'system';

    protected $fillable = [
        'name', 'description', 'version'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
