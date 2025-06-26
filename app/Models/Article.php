<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Article extends Model
{
    use HasFactory;
    use HasTags;

    // protected $table = "articles";
    // protected $fillable = ['articletype_id',
    //     'users_id',
    //     'delet_flag',
    //     'status_id',
    //     'widgetposition_id',
    //     'homePage_status', 'sbutype_id', 'sbu_id', 'usertype', 'viewpermission', 'sbu_type', 'viewer_id', 'main_website_status', 'urlkeyid','officeId'];
    protected $guarded = [];
    public function articleval_sub()
    {
        return $this->hasMany(Articlesub::class, 'articleid', 'id');
    }

    public function articletypeval()
    {
        return $this->belongsTo(Articletype::class, 'articletype_id', 'id');
    }

    public function articledep()
    {
        return $this->hasMany(ArticleDepartment::class, 'articleid', 'id');
    }

    public function office()
    {
        return $this->hasMany(Office::class, 'id', 'officeId');
    }

}
