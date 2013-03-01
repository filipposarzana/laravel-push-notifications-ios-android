<?php

class Push
{

    protected static $config;

    public function __construct($config = null)
    {
        if(is_array($config))
        {
            static::$config = $config;
        }
        else
        {
            static::$config = (Request::env() != 'local') ? Config::get('push::push.prod') : Config::get('push::push.local');
        }
    }

    public static function make($config = null)
    {
        return new static($config);
    }

    public static function getConfig()
    {
        return static::$config;
    }
    
    function android($token, $message = 'Laravel Push Notification', $badge = 1, $sound = 'default', $action_key = 'Open', $custom_parameters = array())
    {

        $config = static::$config['android'];

        $data['message']    = $message;
        $data['badge']      = $badge;
        $data['sound']      = $sound;
        $data['action_key'] = $action_key;

        new Push\Android($token, $data, $config, $custom_parameters);

    }
    
    function ios($token, $message = 'Laravel Push Notification', $badge = 1, $sound = 'default', $action_key = 'Open', $custom_parameters = array())
    {

        $config = static::$config['ios'];

        $data['message']    = $message;
        $data['badge']      = $badge;
        $data['sound']      = $sound;
        $data['action_key'] = $action_key;

        $validation = new Push\Validation(
            array(
                'alert'         => $message.uniqid(),
                'badge'         => $badge,
                'device_token'  => $token
            )
        );

        $validation->validate();

        new Push\iOS($token, $data, $config, $custom_parameters);

    }

}