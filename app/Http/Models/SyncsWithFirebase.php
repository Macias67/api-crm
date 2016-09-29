<?php
/**
 * User: Luis
 * Date: 29/09/2016
 * Time: 06:40 PM
 */

namespace App\Http\Models;

use Firebase\FirebaseInterface;
use Firebase\FirebaseLib;

trait SyncsWithFirebase
{
	/**
	 * @var FirebaseInterface|null
	 */
	protected $firebaseClient;
	
	/**
	 * Boot the trait and add the model events to synchronize with firebase
	 */
	public static function bootSyncsWithFirebase()
	{
		static::created(function ($model)
		{
			$model->saveToFirebase('set');
		});
		static::updated(function ($model)
		{
			$model->saveToFirebase('update');
		});
		static::deleted(function ($model)
		{
			$model->saveToFirebase('delete');
		});
	}
	
	/**
	 * @param FirebaseInterface|null $firebaseClient
	 */
	public function setFirebaseClient($firebaseClient)
	{
		$this->firebaseClient = $firebaseClient;
	}
	
	/**
	 * @param $mode
	 */
	protected function saveToFirebase($mode)
	{
		if (is_null($this->firebaseClient))
		{
			$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		}
		$table = explode("_", $this->getTable());
		unset($table[0]);
		
		$path = implode('-', $table) . '/' . $this->getKey();
		
		if ($mode === 'set' && $fresh = $this->fresh())
		{
			$this->firebaseClient->set($path, $fresh->toArray());
		}
		elseif ($mode === 'update' && $fresh = $this->fresh())
		{
			$this->firebaseClient->update($path, $fresh->toArray());
		}
		elseif ($mode === 'delete')
		{
			$this->firebaseClient->delete($path);
		}
	}
}