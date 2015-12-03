<?php

namespace VoDebug\Dumpers;

class StringDumper implements Dumper
{
    public function dump($subject)
    {
        return sprintf("'%s' (string)", htmlspecialchars(substr($subject, 0, 9000)));
    }
}
