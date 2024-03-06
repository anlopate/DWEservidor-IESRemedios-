<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course', 'ciclo'];

    // Un curso está formado por varios estudiantes
    // el nombre del método va en plural y minuscula
    public function students():HasMany{
        return $this->hasMany('Student::class');

    }
}
