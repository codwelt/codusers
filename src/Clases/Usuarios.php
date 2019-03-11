<?php

namespace App\Source\Usuarios;

use App\Source\Configuracion\Configuracion;
use App\Source\Usuarios\Model;
use App\Source\Tools\Basics;
use App\TipoDocumento;

class Usuarios
{

    const ubicacion = "/public/users/";

    public function listarUsuariosActivos()
    {
        return Basics::collectionToArray(Model::usuariosActivos());
    }

    public function listarUsuariosPaginados()
    {
        return Model::listarUsuariospaginados();
    }

    public function listarUsuarios()
    {
        return Basics::collectionToArray(Model::listarUsuarios());
    }

    public function listarTipoDocumentos()
    {
        return Basics::collectionToArray(TipoDocumento::all());
    }

    public function listaUsuariosTodasLasRelaciones()
    {
        return Basics::collectionToArray(Model::todasLasPropiedades());
    }

    public function listaUsuariosTodasLasRelacionesPaginados()
    {
        return Model::todasLasPropiedadesPaginados();
    }

    public function buscarUsuario($id)
    {
        return Basics::collectionToArray(Model::observarDetalles($id));
    }

    public function eliminarUsuario($id)
    {
        Model::eliminarUsuario($id);
        return redirect()->back();
    }

    public function editarUsuarios($id, $data)
    {
        $data = Basics::determinarRutaimg($data, self::ubicacion);
        Model::editarUsuario($id, $data);
        if (isset($data['ayudante'])) {
            Model::relacionaUsuarioJefe($id, $data['ayudante']);
        }
        return redirect()->back();
    }

    public function crearUsuario($data)
    {
        $data = Basics::determinarRutaimg($data, self::ubicacion);
        $insercion = Model::crearUsuario($data);
        Model::relacionBodegas($data['bodegasId'], $insercion->id);
        Model::relacionUsuarioPerfil($data['perfiles'], $insercion->id);
        return redirect()->back();
    }

    public function buscarUsuarioDocumento($documento, $tipodocumento)
    {
        return Basics::collectionToArray(Model::usuarioBusquedaDocumento($tipodocumento, $documento));
    }
}
