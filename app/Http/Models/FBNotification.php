<?php

namespace App\Http\Models;

class FBNotification
{
	const INFO    = 'info';
	const SUCCESS = 'success';
	const WARNING = 'warning';
	const ERROR   = 'error';
	
	private $titulo    = null;
	private $mensaje   = null;
	private $timestamp = null;
	private $tipo      = null;
	private $visto     = false;
	private $user_id   = null;
	private $group = null;
	
	/**
	 * FBNotification constructor.
	 *
	 * @param null $titulo
	 */
	public function __construct($titulo = null)
	{
		$this->titulo = $titulo;
		$this->timestamp = time();
	}
	
	/**
	 * @return null
	 */
	public function getTitulo()
	{
		return $this->titulo;
	}
	
	/**
	 * @param null $titulo
	 *
	 * @return $this
	 */
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
		
		return $this;
	}
	
	/**
	 * @return null
	 */
	public function getMensaje()
	{
		return $this->mensaje;
	}
	
	/**
	 * @param null $mensaje
	 *
	 * @return $this
	 */
	public function setMensaje($mensaje)
	{
		$this->mensaje = $mensaje;
		
		return $this;
	}
	
	/**
	 * @return null
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}
	
	/**
	 * @param null $timestamp
	 *
	 * @return $this
	 */
	public function setTimestamp($timestamp)
	{
		$this->timestamp = $timestamp;
		
		return $this;
	}
	
	/**
	 * @return null
	 */
	public function getTipo()
	{
		return $this->tipo;
	}
	
	/**
	 * @param null $tipo
	 *
	 * @return $this
	 */
	public function setTipo($tipo)
	{
		$this->tipo = $tipo;
		
		return $this;
	}
	
	/**
	 * @return boolean
	 */
	public function isVisto()
	{
		return $this->visto;
	}
	
	/**
	 * @param boolean $visto
	 *
	 * @return $this
	 */
	public function setVisto($visto)
	{
		$this->visto = $visto;
		
		return $this;
	}
	
	/**
	 * @return null
	 */
	public function getUserId()
	{
		return $this->user_id;
	}
	
	/**
	 * @param null $user_id
	 */
	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}
	
	/**
	 * @return null
	 */
	public function getGroup()
	{
		return $this->group;
	}
	
	/**
	 * @param null $group
	 */
	public function setGroup($group)
	{
		$this->group = $group;
	}
	
	public function toArray()
	{
		return [
			'mensaje'   => $this->mensaje,
			'titulo'    => $this->titulo,
			'tipo'      => $this->tipo,
			'visto'     => $this->visto,
			'timestamp' => $this->timestamp
		];
	}
	
	
}
