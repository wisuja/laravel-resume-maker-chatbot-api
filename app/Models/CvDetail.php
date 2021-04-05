<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvDetail extends Model
{
    use HasFactory;

    protected $fillable = ['cv_id', 'name', 'email', 'phone', 'address', 'keywords', 'skills', 'description', 'education', 'work_experiences', 'links'];

    protected $hidden = ['id', 'cv_id', 'created_at', 'updated_at'];

    public function cv() 
    {
        return $this->belongsTo(Cv::class);
    }
}
