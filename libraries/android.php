<?php

namespace Push;

class Android
{

    public function __construct($token, $data, $config, $custom_parameters)
    {

        $fields = array(
            'registration_ids' => array($token),
            'data'  => $data,
            'extra' => $custom_parameters
        );

        $headers = array(
            'Authorization: key='.$config['api_key'],
            'Content-Type: application/json'
        );

        //OPEN CONNECTION
        $ch = curl_init();

        //SET URL, HEADERS AND OPTION
        curl_setopt($ch, CURLOPT_URL, $config['host']);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //DISABLE SSL VERIFICATION
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //EXECUTE CURL
        $result = curl_exec($ch);

        if ($result === FALSE)
        {
            die('Curl failed: '.curl_error($ch));
        }

        //CLOSE CONNECTION
        curl_close($ch);
        $log = new Log('success', $result);

    }

}