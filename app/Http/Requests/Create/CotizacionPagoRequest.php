<?php

namespace App\Http\Requests\Create;

use App\Http\Models\Cotizacion as CotizacionModelRequest;
use Dingo\Api\Http\FormRequest as Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CotizacionPagoRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		/**
		 * Valido que el contacto pertenece al cliente de la cotización
		 */
		$cotizacion = CotizacionModelRequest::find($this->get('cotizacion_id'));
		$existeContacto = $cotizacion->cliente->contactos->contains($this->get('contacto_id'));
		
		return $existeContacto;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'cotizacion_id'       => 'required|integer|exists:ct_cotizacion,id',
			'contacto_id'         => 'required|integer|exists:cl_contactos,id',
			'cantidad'            => 'required|numeric',
			'tipo'                => 'required|in:abono,total',
			'archivo.url'         => 'required|active_url',
			'archivo.contentType' => 'required',
			'archivo.fullPath'    => 'required',
			'archivo.hash'        => 'required',
			'archivo.name'        => 'required',
			'archivo.size'        => 'required|integer',
		];
	}
	
	/**
	 * Handle a failed authorization attempt.
	 *
	 * @return mixed
	 */
	protected function failedAuthorization()
	{
		throw new AccessDeniedHttpException('Al parecer el contacto no pertenece al cliente de esta cotización.');
	}
}
