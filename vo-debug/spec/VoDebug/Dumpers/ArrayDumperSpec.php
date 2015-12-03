<?php

namespace spec\VoDebug\Dumpers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use VoDebug\Dumpers\Dumper;

class ArrayDumperSpec extends ObjectBehavior
{
    function it_should_implement_dumper()
    {
        $this->shouldHaveType('VoDebug\Dumpers\Dumper');
    }
    
    public function let(Dumper $dumper)
    {
        $this->beConstructedWith($dumper);
    }


    public function it_should_dump_array_content(Dumper $dumper)
    {
        $this->beConstructedWith($dumper);
        
        $subobject = new \stdClass();
        $subobject->title = "myTitle";
        
        $expected = <<<DUMP
[
\t'foo' => 'bar' (string),
\t'arr' => arrayContent,
\t'obj' => objContent
],

DUMP;
        $array = [
            "subfoo" => "subbar"
        ];
        $subject = [
            'foo' => "bar",
            'arr' => $array,
            "obj" => $subobject,
        ];
        $dumper->dump("bar", 0)->willReturn("'bar' (string)");
        $dumper->dump($array, 0)->willReturn('arrayContent');
        $dumper->dump($subobject, 0)->willReturn('objContent');
        $this->dump($subject)->shouldReturn($expected);
    }
}
