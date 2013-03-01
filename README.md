# Laravel Push Notifications
An Apple and Android Push Notification Service bundle for Laravel

##Instalation
=============
###Artisan
```php
php artisan bundle:install laravel-push-notifications-ios-android
```
###Manualy
```php
https://github.com/filipposarzana/laravel-push-notifications-ios-android/
```
##Bundle Registration
=====================

Add the following code to your **application/bundle.php** file:

```php
'push' => array(
  	'auto' 		=> true,
		'handles'	=> 'push'
	)
```

##Certificate for iOS
===============
Paste your certificate into **push/certificates/** and change configurations if you've changed file name

##Configuration
===============
Edit the **config/push.php** file with your settings:

```php
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
```

##Usage
=======

**Instance:**

```php
$push = Push::make();
//or
$push = new Push;
```

**Custom configuration:**

```php
$push = Push::make(
	array(
		'host' => 'gateway.sandbox.push.apple.com:2195',
		'cert' => 'yourcertificate.pem'
	)
);
```

**Parameters**
```php
YOUR TOKEN -> mandatory
MESSAGE -> string
BADGE -> integer (incremental badge has to be done serverside)
SOUND -> custom sound file
ACTION KEY -> Slide to 'ACTION KEY'
EXTRA PARAMETERS -> array(). Add any extra parameters as array to be sent to the application and do extra functions such as open a defined view.
```

**Certificate for iOS**
Paste your certificate into **push/certificates/** and change configurations if you've changed file name

**Send a message:**
iOS
```php
$push->ios('YOUR TOKEN', 'MESSAGE', 'BADGE', 'SOUND', 'ACTION KEY', 'EXTRA PARAMETERS');

```

Android
```php
$push->android('YOUR TOKEN', 'MESSAGE', 'BADGE', 'SOUND', 'ACTION KEY', 'EXTRA PARAMETERS');

```

Questions [@fsarzana](http://twitter.com/fsarzana)



