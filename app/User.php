<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait; 
    use HasRoles; 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    if ($user->hasRole('Administrador')){
        $user->givePermissionTo('edit Clientes', 'delete Clientes', 'edit Productos', 'delete Productos', 'edit Inventario', 'delete Inventario', 'edit MovimientoInventario', 'delete MovimientoInventario');
    }

    if ($user->hasRole('Usuario')){
        $user->givePermissionTo('create Clientes', 'read Clientes', 'create Productos', 'read Productos', 'create Inventario', 'read Inventario', 'create MovimientoInventario', 'read MovimientoInventario');   
    }
}
