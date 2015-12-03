<?php

namespace spec\VoDebug\Dumpers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use VoDebug\Dumpers\Dumper;

class ObjectDumperSpec extends ObjectBehavior
{
    function it_should_implement_dumper()
    {
        $this->shouldHaveType('VoDebug\Dumpers\Dumper');
    }
    
    public function let(Dumper $dumper)
    {
        $this->beConstructedWith($dumper);
    }    
    
    public function it_should_dump_object_content(Dumper $dumper)
    {
        $this->beConstructedWith($dumper);
        
        $expected = <<<DUMP
[
\t'array' => arrayContent,
\t'man' => 'get man' (string),
\t'woman' => 'is woman' (string),
\t'child' => 'has child' (string)
],

DUMP;
        
        $array = [
            "subfoo" => "subbar"
        ];
        $subject = $this->constructSubject($array);
        
        $dumper->dump("get man", 0)->willReturn("'get man' (string)");
        $dumper->dump("is woman", 0)->willReturn("'is woman' (string)");
        $dumper->dump("has child", 0)->willReturn("'has child' (string)");
        $dumper->dump("bar", 0)->willReturn("'bar' (string)");
        $dumper->dump($array, 0)->willReturn('arrayContent');
        $this->dump($subject)->shouldReturn($expected);
    }
    
    /**
     * 
     * @param array $array
     * @param \stdClass $subobject
     * @return \stdClass
     */
    private function constructSubject($array)
    {  
        
        $subject = new TestSubjectSpec();
        
        return $subject;
    }
}
