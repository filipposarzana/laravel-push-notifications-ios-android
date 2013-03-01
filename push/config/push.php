<?php

    return array(
    	'local' => array(
    		'ios' => array(
    			'host'  	=> 'gateway.sandbox.push.apple.com:2195',
		        'cert'  	=> path('bundle').'push/certificates/ck.pem',
		        'pwd'		=> '***'
    		),
    		'android' => array(
    			'id_project'	=> '***',
        		'api_key'		=> '***',
        		'host'			=> 'https://android.googleapis.com/gcm/send'
    		),
    	),
    	'prod' => array(
    		'ios' => array(
    			'host'  	=> 'gateway.push.apple.com:2195',
		        'cert'  	=> path('bundle').'push/certificates/ck.pem',
		        'pwd'		=> '***'
    		),
    		'android' => array(
    			'id_project'	=> '***',
        		'api_key'		=> '***',
        		'host'			=> 'https://android.googleapis.com/gcm/send'
    		),
    	),
    );