<?php

namespace App\Console\Commands;

use App\Events\NotificaUsuario;
use App\Http\Models\Agenda;
use App\Http\Models\FBNotification;
use Illuminate\Console\Command;

class NotificaUsuarios extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'notifica:agenda';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Manda notificación de sus próximos eventos';
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$eventos = Agenda::where('start', '>', date('Y-m-d H:i:s', time()))
		                 ->where('start', '<=', date('Y-m-d H:i:s', (time() + 60 * 15)))
		                 ->orderBy('start', 'desc')
		                 ->get();
		
		$eventos->reject(function ($evento)
		{
			return $evento->notificado === 1;
		})->map(function ($evento)
		{
			$notificacion = new FBNotification('Recordatorio: ' . $evento->titulo);
			$notificacion->setMensaje($evento->descripcion . ' Es hoy a las ' . date('h:i A', strtotime($evento->start)) . '.')
			             ->setTipo(FBNotification::INFO);
			
			event(new NotificaUsuario($notificacion));
			
			$evento->notificado = 1;
			$evento->save();
		});
	}
}
