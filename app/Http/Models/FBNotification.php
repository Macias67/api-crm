<?php

namespace App\Http\Models;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\OptionsPriorities;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FBNotification
{
	const INFO    = 'info';
	const SUCCESS = 'success';
	const WARNING = 'warning';
	const ERROR   = 'error';
	
	private $payloadNotificationBuilder;
	private $payloadDataBuilder;
	private $optionsBuilder;
	private $optionsPriorities;
	
	
	/**
	 * @return \LaravelFCM\Message\PayloadNotificationBuilder
	 */
	public function getPayloadNotificationBuilder()
	{
		if (is_null($this->payloadNotificationBuilder))
		{
			return $this->payloadNotificationBuilder = new PayloadNotificationBuilder();
		}
		
		return $this->payloadNotificationBuilder;
	}
	
	/**
	 * @return \LaravelFCM\Message\PayloadDataBuilder
	 */
	public function getPayloadDataBuilder()
	{
		if (is_null($this->payloadDataBuilder))
		{
			return $this->payloadDataBuilder = new PayloadDataBuilder();
		}
		
		return $this->payloadDataBuilder;
	}
	
	/**
	 * @return \LaravelFCM\Message\OptionsBuilder
	 */
	public function getOptionsBuilder()
	{
		if (is_null($this->optionsBuilder))
		{
			return $this->optionsBuilder = new OptionsBuilder();
		}
		
		return $this->optionsBuilder;
	}
	
	/**
	 * @return \LaravelFCM\Message\OptionsPriorities
	 */
	public function getOptionsPriorities()
	{
		if (is_null($this->optionsPriorities))
		{
			return $this->optionsPriorities = new OptionsPriorities();
		}
		
		return $this->optionsPriorities;
	}
}
