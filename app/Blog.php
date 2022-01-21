<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $fillable = ['article_title', 'short_description', 'article_description', 'article_type', 'video_url', 'posted_url', 'posted_by', 'posted_dep', 'tags', 'publish_status', 'created_date_time'];

    public function user()
    {
        return $this->belongsTo(\App\TeamMember::class, 'posted_by');
    }

    public function users() {
        return $this->belongsTo(\App\Users::class,'posted_by');
    }

    public function category()
    {
        return $this->belongsTo(\App\BlogCategory::class, 'posted_dep');
    }
}
