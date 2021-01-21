<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    // Relacion 1:n ubicacion y vacantes
    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }
}
