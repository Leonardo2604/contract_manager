<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $table = 'module';

    protected $fillable = [
        'system_id', 'name', 'description',
        'version', 'value', 'monthly_value'
    ];

    protected $casts = [
        'value' => 'float',
        'monthly_value' => 'float'
    ];

    public function scopeOfSystem(Builder $query, int $systemId): Builder
    {
        return $query->where('system_id', $systemId);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }
}
