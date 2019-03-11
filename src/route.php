/** RUTAS DE USUARIOS **/
Route::middleware(['auth'])->group(function () {
Route::get('/usuarios/listar/json', 'UsuariosController@index')->name('usuario');
Route::get('/usuarios/eliminar/{id}', 'UsuariosController@destroy')->name('usuarioeliminar');
Route::post('/usuarios/crear/', 'UsuariosController@store')->name('usuarioscrear');
Route::patch('/usuarios/editar/{id}', 'UsuariosController@update')->name('usuarioeditar');
});
/** RUTAS DE USUARIOS **/