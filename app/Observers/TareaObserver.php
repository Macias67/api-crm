<?php
/**
 * User: Luis
 * Date: 01/11/2016
 * Time: 03:39 PM
 */

namespace App\Observers;

use App\Http\Models\CasoEstatus;
use App\Http\Models\Tarea;
use App\Http\Models\TareaEstatus;

class TareaObserver
{
	
	/**
	 * Listen to the Caso created event.
	 *
	 * @param \App\Http\Models\Tarea $tarea
	 *
	 */
	public function created(Tarea $tarea)
	{
		/**
		 * @TODO enviar email y notificacion push
		 */
	}
	
	
	/**
	 * Listen to the Caso updated event.
	 *
	 * 1. Si la tarea esta ASIGNADO|REASIGNADO|PROCESO|SUSPENDIDO y avance es mayor  a 100, entonces
	 * cambio el estatus de la tarea a PROCESO, calculo avance de todas las tareas activas.
	 * 2. Si el avance esta al 100%, cierro tarea, reviso todas las tareas que esten
	 * cerradas y cambio el estatus del CASO
	 *
	 * @param \App\Http\Models\Tarea $tarea
	 *
	 */
	public function saving(Tarea $tarea)
	{
		if ($tarea->activo)
		{
			$estatus = [TareaEstatus::ASIGNADO, TareaEstatus::PROCESO];
			
			if ($tarea->avance < 100 && in_array($tarea->id_estatus, $estatus))
			{
				$caso = $tarea->caso;
				$tareasActivasCaso = $caso->tareas->where('activo', true);
				
				$tarea->id_estatus = TareaEstatus::PROCESO;
				// Resto el avance de esta tarea a la sumatoria, porque este valor no esta actualizado.
				$diferencia = $tareasActivasCaso->sum('avance') - $tareasActivasCaso->where('id', $tarea->id)->pluck('avance')->first();
				// Se suma $tarea->avance porque en este momento aún no se guarda en la BD.
				$caso->avance = (int)(($diferencia + $tarea->avance) / $tareasActivasCaso->count());
				$caso->save();
			}
			else if ($tarea->avance == 100)
			{
				$tarea->id_estatus = TareaEstatus::CERRADO;
				$tarea->fecha_cierre = date('Y-m-d H:i:s');
				
				$caso = $tarea->fresh()->caso;
				$tareasActivasCaso = $caso->tareas->where('activo', true);
				
				if ($tareasActivasCaso->where('id_estatus', TareaEstatus::CERRADO)->where('avance', 100)->count() == $tareasActivasCaso->count())
				{
					$caso->fecha_precierre = date('Y-m-d H:i:s');
					$caso->estatus_id = CasoEstatus::PRECIERRE;
					
					// Resto el avance de esta tarea a la sumatoria, porque este valor no esta actualizado.
					$diferencia = $tareasActivasCaso->sum('avance') - $tareasActivasCaso->where('id', $tarea->id)->pluck('avance')->first();
					// Se suma $tarea->avance porque en este momento aún no se guarda en la BD.
					$caso->avance = (int)(($diferencia + $tarea->avance) / $tareasActivasCaso->count());
					$caso->encuesta()->create([]);
					$caso->save();
					
					// @TODO Enviar correo al cliente y notificacion PUSH avisan que se PRECERRO el caso
				}
			}
		}
	}
}