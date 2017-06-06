<?php


namespace App\Observers;

use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MovimientoInventarioObserver
{
    /**
    * Listen to the User created event.
    *
    * @param  User  $user
    * @return void
    */
    public function creating(MovimientoInventario $registro)
    {
        \Alert::info('Hola, si funciono!');
        $inventarioQuery = DB::table('inventario')
        ->where('producto_id', '=', $registro->producto_id)
        ->select('cantidad', 'id')->get();

        $cantAnterior = $inventarioQuery[0]->cantidad;
        $inventarioId = $inventarioQuery[0]->id;

        $cantNueva = $registro->cantidad_ingresada+$cantAnterior;
        
        $registro->inventario_id = $inventarioId;
        $registro->cantidad_anterior = $cantAnterior;
        $registro->cantidad_nueva = $cantNueva;

        DB::table('inventario')
        ->where('id', $registro->inventario_id)
        ->update(['cantidad' => $cantNueva]);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(MovimientoInventario $registro)
    {
        //
    }
}