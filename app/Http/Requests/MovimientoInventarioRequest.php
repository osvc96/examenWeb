<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

class MovimientoInventarioRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $inventarioQuery = DB::table('inventario')
        ->where('producto_id', '=', $this->producto_id)
        ->select('cantidad', 'cantidad_maxima', 'id')->get();
        
        if(!(isset($inventarioQuery[0]))){
           \Alert::error('No hay inventario definido para este producto');
           //header("location:javascript://history.go(-1)"."//create");
           return [];
           exit;
        }
        
        $cantidadMax = $inventarioQuery[0]->cantidad_maxima;
        $cantAnterior = $inventarioQuery[0]->cantidad;
        $inventarioId = $inventarioQuery[0]->id;

        $limiteIngreso = $cantidadMax - $cantAnterior;
        //$cantNueva = $this->cantidad_ingresada+$cantAnterior;
        //$request->inventario_id = $inventarioId;
        /*
        $this->cantidad_anterior = $cantAnterior;
        $this->cantidad_nueva = $cantNueva;
        */
        return [
            // 'name' => 'required|min:5|max:255'
            'cantidad_ingresada' => 'numeric|required|max:'.$limiteIngreso
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
