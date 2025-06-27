<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    protected $guarded = [];

    public function announcesub()
    {
        return $this->hasMany(Announcementsub::class, 'announcementid', 'id');
    }

    public function announcetype()
    {
        return $this->hasMany(AnnouncementType::class, 'id', 'announcementtype');
    }
}
