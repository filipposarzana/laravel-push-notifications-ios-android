<?php

namespace Push;

class iOS
{

    public function __construct($token, $data, $config, $custom_parameters)
    {

        //CREATE THE CONNECTION
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $config['cert']);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $config['pwd']);

        //OPEN CONNECTION TO THE APNS SERVER
        $fp = stream_socket_client('ssl://'.$config['host'].'', $err, $errstr, 2, STREAM_CLIENT_CONNECT, $ctx);

        if (!$fp)
        {
            unset($fp);
            exit('Failed to connect: $err $errstr'.PHP_EOL);
        }

        $log = new Log('success', 'Connected to APNS'.PHP_EOL);

        //CREATE THE PAYLOAD BODY Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'body'              => $data['message'].uniqid(),
                'action-loc-key'    => $data['action_key']
            ),
            'sound' => $data['sound'],
            'badge' => $data['badge'],
            'extra'	=> $custom_parameters,
        );

        //ENCODE PAYLOAD AS JSON
        $payload = json_encode($body);

        //BUILD THE BINARY NOTIFICATION
        $msg = chr(0).pack('n', 32).pack('H*', $token).pack('n', strlen($payload)).$payload;

        //SEND TO THE SERVER
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
        {
            $log = new Log('error', 'Message not delivered'.PHP_EOL);
        }
        else
        {
            $log = new Log('success', 'Message successfully delivered'.PHP_EOL);
        }

        //CLOSE SERVER CONNECTION
        fclose($fp);
        unset($fp);

    }

}