<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'director_id',
    ];

    public $timestamps = false;

    public function genres() {
        return $this->belongsToMany(Genre::class, 'videos_genres');
    }

    public function director() {
        return $this->belongsTo(Director::class);
    }

    public function stars() {
        return $this->belongsToMany(Star::class, 'videos_stars');
    }
}
