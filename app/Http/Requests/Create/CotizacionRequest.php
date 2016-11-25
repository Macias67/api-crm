<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class CotizacionRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$productos = $this->get('productos');
		$bancos = $this->get('bancos');
		
		$rules = [
			'cliente_id'  => 'required|integer|exists:cl_clientes,id',
			'contacto_id' => 'required|integer|exists:cl_contactos,id',
			'productos'   => 'required|array',
			'bancos'      => 'required|array',
			'vencimiento' => 'required|date',
			'cxc'         => 'required|boolean',
			'subtotal'    => 'required|numeric',
			'iva'         => 'required|numeric',
			'total'       => 'required|numeric'
		];
		
		foreach ($productos as $index => $producto)
		{
			$rules['productos.' . $index . '.id'] = 'required|integer|exists:ec_productos,id';
			$rules['productos.' . $index . '.cantidad'] = 'required|integer';
			$rules['productos.' . $index . '.precio'] = 'required|numeric';
			$rules['productos.' . $index . '.descuento'] = 'required|numeric';
			$rules['productos.' . $index . '.subtotal'] = 'required|numeric';
			$rules['productos.' . $index . '.iva'] = 'required|numeric';
			$rules['productos.' . $index . '.total'] = 'required|numeric';
			$rules['productos.' . $index . '.descripcion'] = 'required';
		}
		foreach ($bancos as $index => $banco)
		{
			$rules['bancos.' . $index] = 'required|integer|exists:ec_bancos,id';
		}
		
		return $rules;
	}
}
