<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogDemo extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'logdemo';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Ejemplo de Log Programable';
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$logger = new Logger('TEST-Laravel');
		$logger->pushHandler(new StreamHandler(storage_path('logs/my-logs.log')));
		$logMessage = 'Estuve aquí @ ' . Carbon::now();
		$logger->info($logMessage);
	}
}
