<?php

namespace Push;

class Validation
{
	protected $input;

	public function __construct($input)
	{
		\Laravel\Validator::register('hexa', function($attributes, $value, $parameters)
		{
			return ctype_xdigit($value);
		});

		$this->input = $input;	
	}

	public function validate()
	{
		$validator = \Laravel\Validator::make(
			$this->input, 
			array(
				'alert'			=> 'required|max:120',
				'badge'			=> 'numeric',
				'device_token'	=> 'hexa'
			), 
			array(
				'hexa'	=> 'The :attribute must be xdigits.'
			)			
		);

		if($validator->invalid())
		{
			throw new Exception($validator);
		}
	}

}