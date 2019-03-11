<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'rutaimg', 'email_verified_at', 'password', 'telefono', 'documento', 'tipodocumento',
        'direccion', 'ciudad', 'nivelaccesso', 'estado', 'idpadre', 'remember_token', 'cliente'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function perfiles()
    {
        return $this->belongsToMany('App\Perfiles', 'perfiles_users', 'users_id', 'perfiles_id');
    }

    public function tipodocumento()
    {
        return $this->belongsTo('App\TipoDocumento', 'tipodocumento', 'id');
    }

    public function bodegas()
    {
        return $this->belongsToMany('App\Bodegas', 'bodegas_user', 'user_id', 'bodegas_id');
    }

    public function compras()
    {
        return $this->hasMany('App\Carrito', 'usuario_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Ventas', 'idvendedor', 'id');
    }

    public function ayudantes()
    {
        return $this->hasMany('App\User', 'idpadre', 'id');
    }

    public function jefes()
    {
        return $this->belongsTo('App\User', 'idpadre', 'id');
    }
}
