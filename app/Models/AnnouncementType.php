<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementType extends Model
{
    use HasFactory;

    protected $table = 'announcementtypes';

    protected $guarded = [];

    public function announcetypesub()
    {
        return $this->hasMany(AnnouncementTypeSub::class, 'announcementtypeid', 'id');
    }
}
