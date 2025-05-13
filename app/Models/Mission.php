<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'mission';

    protected $fillable = [
        'name',
        'launch_date',
        'launch_site_name',
        'launch_site_latitude',
        'launch_site_longitude',
        'landing_date',
        'landing_site_name',
        'landing_site_latitude',
        'landing_site_longitude',
        'spacecraft_id',
    ];

    public function space_crafts()
    {
        return $this->belongsTo(Spacecraft::class, 'spacecraft_id');
    }
}
