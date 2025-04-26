<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaunchDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'launch_date',
        'launch_site_id',
    ];

    public function launchSite()
    {
        return $this->belongsTo(LaunchSite::class);
    }

}
