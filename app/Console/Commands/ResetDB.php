<?php

namespace App\Console\Commands;

use Firebase\FirebaseLib;
use Illuminate\Console\Command;

class ResetDB extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:reset';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Reset a la base de datos';
	
	/**
	 * Create a new command instance.
	 *
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
		$firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		$firebaseClient->delete('/');
		
		shell_exec('mysql --user=root --password= --database=api-crm < database/borradb.sql');
		shell_exec('mysql --user=root --password= --database=api-crm < database/creaesquema.sql');
		$this->call('db:seed', []);
	}
}
