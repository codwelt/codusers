@extends('system.usuarios.usuarios')
@section('contentusuarios')
    <div class="container-fluid">
        @for($a = 0; $a < count($detalles); $a++)
            <div class="row">
                <div class="col-md-2">
                    <h3 class="titulos">Personal a cargo</h3>
                    <ul class="list-group">
                        @for($b = 0; $b < count($detalles[$a]['ayudantes']); $b++)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$detalles[$a]['ayudantes'][$b]['name']}}
                                <span class="badge badge-pill"><a
                                        href="{{route('detallesusuarios', ['id' => $detalles[$a]['ayudantes'][$b]['id']])}}">
                                            <i class="fas fa-eye"></i></a></span>
                            </li>
                        @endfor
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        @if(!is_null($detalles[$a]['rutaimg']))
                            <div class="col-md-3 imagenusuariomain">
                                <img src="{{$detalles[$a]['rutaimg']}}" alt="{{$detalles[$a]['name']}}"
                                     class="imagenusuario">
                            </div>
                            <div class="col-md-9">
                                @else
                                    <div class="col-md-12">
                                        @endif
                                        <div class="row infousuario">
                                            <div class="col-12">
                                                <h3 class="titulos">{{$detalles[$a]['name']}}</h3>
                                                <hr>
                                                <ul class="nav justify-content-center">
                                                    <li class="nav-item">
                                                        <a href="#!" class="nav-link active" data-toggle="modal"
                                                           data-target=".bd-example-modal-xl"><i
                                                                class="fas fa-user"></i> Editar </a>
                                                    </li>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->nivelaccesso  == 10)
                                                        <li class="nav-item">
                                                            <a href="{{route('usuarioeliminar', ['id' => $detalles[$a]['id']])}}"
                                                               class="nav-link active"><i
                                                                    class="fas fa-trash"></i> Desactivar</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-3"><h4>Correo:</h4> {{$detalles[$a]['email']}}</div>
                                            <div class="col-md-2"><h4>Teléfono:</h4> {{$detalles[$a]['telefono']}}</div>
                                            <div class="col-md-4">
                                                <h4>Documento:</h4> {{$detalles[$a]['tipodocumento']['nombre']}}
                                                No. {{$detalles[$a]['documento']}}</div>

                                            <div class="col-md-2">
                                                <h4>Perfil:</h4>
                                                @for($b = 0; $b < count($detalles[$a]['perfiles']); $b++)
                                                    - {{$detalles[$a]['perfiles'][$b]['nombre']}}
                                                @endfor
                                            </div>
                                            <div class="col-md-1">
                                                <h4>Acceso</h4>
                                                {{$detalles[$a]['nivelaccesso']}}
                                            </div>
                                            <div class="col-md-3">
                                                <h4>Bodegas:</h4>
                                                @for($c = 0; $c < count($detalles[$a]['perfiles']); $c++)
                                                    {{$detalles[$a]['bodegas'][$c]['referencia']}}
                                                    - {{$detalles[$a]['bodegas'][$c]['nombre']}},
                                                @endfor
                                            </div>
                                            <div class="col-md-4"><h4>Dirección:</h4> {{$detalles[$a]['direccion']}}
                                                , {{$detalles[$a]['ciudad']}} </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="titulos">Lista de compras</h3>
                                                <hr>
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Cantidad</th>
                                                        <th scope="col">Producto</th>
                                                        <th scope="col">Valor</th>
                                                        <th scope="col"></th>
                                                        <th scope="col">Fecha compra</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if(count($detalles[$a]['compras']) > 0)
                                                        @for($d = 0; $d < count($detalles[$a]['compras']); $d++)
                                                            <tr>
                                                                <td>{{$detalles[$a]['compras'][$d]['cantidad']}}</td>
                                                                <td>{{$detalles[$a]['compras'][$d]['productos']['nombre']}}</td>
                                                                <td>{{number_format($detalles[$a]['compras'][$d]['productos']['valor'])}}</td>
                                                                <td>
                                                                    <a href="{{route('verproducto', ['id' => $detalles[$a]['compras'][$d]['id']])}}"><i
                                                                            class="fas fa-eye"></i></a>
                                                                </td>
                                                                <td>{{$detalles[$a]['compras'][$d]['created_at']}}</td>
                                                            </tr>
                                                        @endfor
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="titulos">Lista de ventas</h3>
                                                <hr>
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Metodo de pago</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Items</th>
                                                        <th scope="col">Fecha venta</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if(count($detalles[$a]['ventas']) > 0)
                                                        @for($e = 0; $e < count($detalles[$a]['ventas']); $e++)
                                                            <tr>
                                                                <td>{{$detalles[$a]['ventas'][$e]['metododepago']['nombre']}}</td>
                                                                <td>{{number_format($detalles[$a]['ventas'][$e]['total'])}}</td>
                                                                <td>{{count($detalles[$a]['ventas'][$e]['carrito'])}}</td>
                                                                <td>{{$detalles[$a]['ventas'][$e]['created_at']}}</td>
                                                                <td>
                                                                    <a href=""><i
                                                                            class="fas fa-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                                         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualización de
                                                        usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{route('usuarioeditar', ['id' => $detalles[$a]['id']])}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="hidden" id="usuarioid"
                                                               value="{{$detalles[$a]['id']}}">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nombres</label>
                                                            <input type="text" class="form-control" name="nombre"
                                                                   value="{{$detalles[$a]['name']}}"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Correos</label>
                                                            <input type="email" class="form-control" name="email"
                                                                   value="{{$detalles[$a]['email']}}"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Teléfono</label>
                                                            <input type="text" class="form-control" name="telefono"
                                                                   value="{{$detalles[$a]['telefono']}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="rutaimagenold"
                                                                   value="{{$detalles[$a]['rutaimg']}}">
                                                            <input type="hidden" name="id"
                                                                   value="{{$detalles[$a]['id']}}">
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
                                                            <label for="exampleFormControlSelect1">Tipo
                                                                documento</label>
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
                                                                   value="{{$detalles[$a]['documento']}}"
                                                                   name="documento"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Dirección</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$detalles[$a]['direccion']}}"
                                                                   name="direccion"
                                                                   required>
                                                        </div>
                                                        <h4>Ayudantes</h4>
                                                        <hr>
                                                        <a href="#!" onclick="agregarUsuarioEmpleado()"><i
                                                                class="fas fa-plus"></i> Relacionar ayudante</a>
                                                        <br><br>
                                                        <div id="anexoayudanteusuario" class="form-row">

                                                        </div>
                                                        <hr>


                                                        @if(Auth::user()->nivelaccesso  == 10)
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Nivel de
                                                                    acceso</label>
                                                                <select class="form-control"
                                                                        id="exampleFormControlSelect1"
                                                                        name="nivelacceso"
                                                                        required>
                                                                    <option
                                                                        value="{{$detalles[$a]['nivelaccesso']}}"></option>
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
                                                        @else
                                                            <input type="hidden" name="nivelacceso"
                                                                   value="{{$detalles[$a]['nivelaccesso']}}">
                                                        @endif
                                                        <input type="submit" class="btn btn-primary btn-block"
                                                               value="Actualizar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
