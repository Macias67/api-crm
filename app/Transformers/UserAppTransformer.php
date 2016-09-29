<?php
/**
 * User: Luis
 * Date: 27/09/2016
 * Time: 07:08 PM
 */

namespace App\Transformers;

use App\Http\Models\UserApp;
use League\Fractal\TransformerAbstract;

class UserAppTransformer extends TransformerAbstract
{
	public function transform(UserApp $user)
	{
		$roles = $user->roles;
		$dRoles = [];
		foreach ($roles as $index => $role)
		{
			$permisos = $role->permisos;
			$dPermisos = [];
			foreach ($permisos as $pindex => $permiso)
			{
				$dPermisos[$pindex] = [
					'id'          => $permiso->id,
					'nombre'      => $permiso->name,
					'display'     => $permiso->display_name,
					'descripcion' => $permiso->description,
				];
			}
			
			$dRoles[$index] = [
				'id'          => $role->id,
				'nombre'      => $role->name,
				'display'     => $role->display_name,
				'descripcion' => $role->description,
				'permisos'    => $dPermisos
			];
		}
		
		$data = [
			'id'       => $user->id,
			'nombre'   => $user->nombre,
			'apellido' => $user->apellido,
			'avatar'   => $user->avatar,
			'online'   => $user->online,
			'email'    => $user->email,
			'roles'    => $dRoles
		];
		
		if ($user->ejecutivo && $user->infoEjecutivo)
		{
			$infoEjecutivo = $user->infoEjecutivo;
			$data['ejecutivo'] = [
				'oficina'      => [
					'calle'     => $infoEjecutivo->oficina->calle,
					'numero'    => $infoEjecutivo->oficina->numero,
					'colonia'   => $infoEjecutivo->oficina->colonia,
					'cp'        => $infoEjecutivo->oficina->cp,
					'ciudad'    => $infoEjecutivo->oficina->ciudad,
					'estado'    => $infoEjecutivo->oficina->estado,
					'latitud'   => $infoEjecutivo->oficina->latitud,
					'longitud'  => $infoEjecutivo->oficina->longitud,
					'telefonos' => explode(',', $infoEjecutivo->oficina->telefonos),
					'email'     => $infoEjecutivo->oficina->email,
				],
				'departamento' => $infoEjecutivo->departamento,
			];
		}
		else if (!$user->ejecutivo && $user->infoContacto)
		{
			$infoContacto = $user->infoContacto;
			$data['cliente'] = [
				'id'           => $infoContacto->cliente->id,
				'razonsocial'  => $infoContacto->cliente->razonsocial,
				'rfc'          => $infoContacto->cliente->rfc,
				'prospecto'    => (bool)$infoContacto->cliente->prospecto,
				'distribuidor' => (bool)$infoContacto->cliente->distribuidor,
				'email'        => $infoContacto->cliente->email,
				'online'       => $infoContacto->cliente->online,
			];
		}
		
		if (isset($user->token))
		{
			$data['token'] = $user->token;
		}
		
		$data['created_at'] = $user->created_at->getTimestamp();
		$data['updated_at'] = $user->updated_at->getTimestamp();
		
		return $data;
	}
}