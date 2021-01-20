<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Relacion 1:n categorias y vacantes
    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }
}
