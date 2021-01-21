<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    // Relacion 1:n experiencia y vacantes
    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }
}
