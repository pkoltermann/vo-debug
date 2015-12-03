<?php

namespace VoDebug\Dumpers;

class ObjectDumper implements Dumper
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

    public function dump($subject, $nestLevel = 0)
    {        
        $elements = [];
        foreach (get_object_vars($subject) as $key => $value) {
            $elements[] = sprintf("'%s' => %s", $key, $this->masterDumper->dump($value, $nestLevel));
        }
        
        $methods = get_class_methods($subject);
        $approvedMethods = array_filter($methods, function($element) {
            return preg_match("/^(get|has|is)/", $element) !== false;
        });
        
        foreach ($approvedMethods as $method) {
            $key = lcfirst(preg_replace("/^(get|has|is)/", '', $method));
            $value = call_user_func([$subject, $method]);
            $elements[] = sprintf("'%s' => %s", $key, $this->masterDumper->dump($value, $nestLevel));
        }
        
        return "[\n\t" . implode(",\n\t", $elements) . "\n],\n";
    }
}
