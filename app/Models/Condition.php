<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    public function patients(){
        return $this->belongsToMany(Patient::class)->withPivot('created_at');
    }

    protected $fillable = ['condition'];
}
