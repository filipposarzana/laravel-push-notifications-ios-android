<?php

namespace Push;

class Log
{

    public function __construct($view, $text)
    {
        echo $view.': '.$text.'<br>';
    }

}