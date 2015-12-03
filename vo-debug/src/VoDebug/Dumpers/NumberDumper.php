<?php

namespace VoDebug\Dumpers;

class NumberDumper implements Dumper
{
    public function dump($subject)
    {
        return "{$subject} (number)";
    }
}
