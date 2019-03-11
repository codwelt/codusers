@extends('system.usuarios.usuarios')
@section('contentusuarios')
    <div class="row detallesusuario">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            <h3 class="titulos">Lista de usuarios</h3>
            <hr>
            <ul class="nav justify-content-left">
                @if(Auth::user()->nivelaccesso  == 10)
                    <li class="nav-item">
                        <a href="#!" class="nav-link active" data-toggle="modal" data-target=".bd-example-modal-xxl"><i
                                class="fas fa-user"></i> Agregar
                            usuario</a>
                    </li>
                @endif
            </ul>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Bodega</th>
                    <th scope="col">Rol</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $us)
                    <tr>
                        <th>{{$us->name}}</th>
                        <td>{{$us->email}}</td>
                        <td>{{$us->telefono}}</td>
                        <td>@for($a = 0; $a < count($us->bodegas); $a++)
                                - {{$us->bodegas[$a]->nombre}}
                            @endfor
                        </td>
                        <td>
                            @for($c = 0; $c < count($us->perfiles); $c++)
                                - {{$us->perfiles[$c]->nombre}}
                            @endfor
                        </td>
                        <td>
                            <a href="{{route('detallesusuarios', ['id' => $us->id])}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endsection
        </div>
    </div>
    <div class="modal fade bd-example-modal-xxl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('usuarioscrear')}}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombres</label>
                            <input type="text" class="form-control" name="nombre"
                                   value=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Correos</label>
                            <input type="email" class="form-control" name="email"
                                   value=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Contraseña</label>
                            <input type="password" class="form-control" name="password"
                                   value=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Teléfono</label>
                            <input type="text" class="form-control" name="telefono"
                                   value="" required>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                       id="customFileLang" lang="es"
                                       name="rutaimg">
                                <label class="custom-file-label" for="customFileLang">Seleccionar
                                    Archivo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Tipo documento</label>
                            <select class="form-control" id="exampleFormControlSelect1"
                                    name="tipodocumento"
                                    required>

                                <option selected></option>
                                @for($b = 0; $b < count($documentos); $b++)
                                    <option
                                        value="{{$documentos[$b]['id']}}">{{$documentos[$b]['nombre']}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Documento</label>
                            <input type="text" class="form-control"
                                   value="" name="documento"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bodega</label>
                            <select class="form-control" id="exampleFormControlSelect1"
                                    name="bodegasId"
                                    required>

                                <option selected></option>
                                @for($c = 0; $c < count($bodegas); $c++)
                                    <option
                                        value="{{$bodegas[$c]['id']}}">{{$bodegas[$c]['nombre']}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Dirección</label>
                            <input type="text" class="form-control"
                                   value="" name="direccion"
                                   required>
                        </div>
                        @if(count($perfiles) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4>Perfiles</h4>
                                </div>
                                @for($a = 0; $a < count($perfiles); $a++)
                                    <div class="col-md">
                                        <input type="checkbox" id="{{$perfiles[$a]['nombre']}}"
                                               name="perfiles[]" value="{{$perfiles[$a]['id']}}">
                                        <label for="{{$perfiles[$a]['nombre']}}">{{$perfiles[$a]['nombre']}}</label>
                                    </div>
                                @endfor
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nivel de acceso</label>
                            <select class="form-control" id="exampleFormControlSelect1"
                                    name="nivelacceso"
                                    required>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block"
                               value="Agregar">
                    </form>
                </div>
            </div>
        </div>
    </div>
