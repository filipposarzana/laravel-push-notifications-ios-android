<?php
    // /bundles/push/start.php
    Autoloader::map(array(
        'Push' => path('bundle').'/push/libraries/push.php'
    ));

    Autoloader::namespaces(array(
		'Push' => Bundle::path('push').'libraries'
	));