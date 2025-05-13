<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceCraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'command_module',
        'lunar_module',
    ];

    public function crews()
    {
        return $this->hasMany(Crew::class, 'spacecraft_id');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
