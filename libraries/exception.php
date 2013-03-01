<?php

namespace Push;

class Exception extends Exception
{

	private $errors;

	public function __construct(Validator $container)
	{
		$this->errors = $container->errors;

		parent::__construct(null);
	}

	public function get()
	{
		return $this->errors;
	}
}