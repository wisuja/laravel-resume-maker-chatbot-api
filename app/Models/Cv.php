<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['cv_detail'];

    protected $hidden = ['id', 'user_id', 'created_at', 'updated_at'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function cv_detail() 
    {
        return $this->hasOne(CvDetail::class);
    }
}
