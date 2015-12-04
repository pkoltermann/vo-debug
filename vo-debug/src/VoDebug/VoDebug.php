<?php

namespace VoDebug;

use VoDebug\Dumpers\NumberDumper;
use VoDebug\Dumpers\StringDumper;
use VoDebug\Dumpers\ArrayDumper;
use VoDebug\Dumpers\ObjectDumper;

/**
 * ValueObjectDebuger
 * 
 * This tool can be used to list ValueObject attributes with its types and content if it is simple type.
 */
class VoDebug implements Dumpers\Dumper
{
    /**
     *
     * @var int
     */
    private $maxNestLevel = 5;
    
    /**
     * @var ObjectDumper
     */
    private $objectDumper;

    /**
     * @var ArrayDumper
     */
    private $arrayDumper;

    /**
     * @var NumberDumper
     */
    private $numberDumper;

    /**
     * @var StringDumper
     */
    private $stringDumper;

    public function setDumpers(
        StringDumper $stringDumper, 
        NumberDumper $numberDumper,
        ArrayDumper $arrayDumper, 
        ObjectDumper $objectDumper
    )
    {
        
        $this->stringDumper = $stringDumper;
        $this->numberDumper = $numberDumper;
        $this->arrayDumper = $arrayDumper;
        $this->objectDumper = $objectDumper;
    }

    public function dump($subject, $nestLevel = 0)
    {
        if ($nestLevel > $this->maxNestLevel) {
            return "...";
        }
        switch (gettype($subject)) {
            case "string":
                $result = $this->stringDumper->dump($subject);
                break;
            case "double":
            case "integer":
                $result = $this->numberDumper->dump($subject);
                break;
            case "array":
                $result = $this->arrayDumper->dump($subject, $nestLevel + 1);
                break;
            case "object":
                $result = $this->objectDumper->dump($subject, $nestLevel + 1);
                break;
            case "boolean":
                $result = sprintf("%s (boolean)", $subject ? "true" : "false");
                break;
            case "resource":
                $result = "resource";
            case "NULL":
                $result = "null";
                break;
            default:
                $result = "Unknown type";
        }
        return $result;
    }
}
