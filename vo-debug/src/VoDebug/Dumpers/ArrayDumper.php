<?php

namespace VoDebug\Dumpers;

use VoDebug\Dumpers\Dumper;

class ArrayDumper implements Dumper
{
    /**
     *
     * @var Dumper
     */
    private $masterDumper;
    
    /**
     * 
     * @param Dumper $dumper
     */
    public function __construct(Dumper $dumper)
    {
        $this->masterDumper = $dumper;
    }

    /**
     * 
     * @param mixed $subject
     * @return string
     */
    public function dump($subject, $nestLevel = 0)
    {
        $elements = [];
        foreach ($subject as $key => $value) {
            $elements[] = sprintf("'%s' => %s", $key, $this->masterDumper->dump($value, $nestLevel));
        }
        
        return "[\n\t" . implode(",\n\t", preg_replace("/\n/", "\n\t", $elements)) . "\n],\n";
    }
}
