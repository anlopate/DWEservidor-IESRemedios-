<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;

class Student extends Model
{
    use HasFactory;

    protected $fillabel = ['name', 'surname' , 'birth_date', 'phone', ' city', 'dni', 'email','course_id']; 

    // Un alumno pertenece a un curso
    // El nombre del método va en plural y minúscula
    public function course():BelongsTo{
        return $this->belongsTo(Course::class);

    }
}
