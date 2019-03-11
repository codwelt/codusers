<?php

namespace App\Source\Clientes;

use App\Source\Tools\Basics;
use App\Source\Usuarios\Model;

class Clientes
{
    const ubicacion = "/public/clientes/";

    public function crearCliente($data)
    {
        $data = Basics::determinarRutaimg($data, self::ubicacion);
        Model::crearCliente($data);
        return redirect()->back();
    }

    public function editarCliente($id, $data)
    {
        Model::editarCliente($id, $data);
        return redirect()->back();
    }
}
