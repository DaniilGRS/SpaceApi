<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceCraft extends Model
{
    use HasFactory;


    public function crews()
    {
        return $this->hasMany(Crew::class, 'spacecraft_id');
    }

    protected $fillable = [
        'command_module',
        'lunar_module',
    ];
}
