<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    // Relacion 1:n salario y vacantes
    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }
}
