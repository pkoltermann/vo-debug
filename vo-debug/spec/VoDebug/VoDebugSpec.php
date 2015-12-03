<?php

namespace spec\VoDebug;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use VoDebug\Dumpers\StringDumper;
use VoDebug\Dumpers\ArrayDumper;
use VoDebug\Dumpers\NumberDumper;
use VoDebug\Dumpers\ObjectDumper;

class VoDebugSpec extends ObjectBehavior
{
   
    public function it_should_return_correct_debug(
        ArrayDumper $arrayDumper, 
        NumberDumper $numberDumper, 
        ObjectDumper $objectDumper,
        StringDumper $stringDumper
    )
    {
        $this->setDumpers($stringDumper, $numberDumper, $arrayDumper, $objectDumper);
        
        
        $this->testSingle('foobar', "'foobar' (string)", $stringDumper);
        $this->testSingle(1.23, "1.23 (number)", $numberDumper);
        $this->testSingleNested(['aa'], "['aa']", $arrayDumper);
        $this->testSingleNested(new \stdClass(), "['']", $objectDumper);
        
        $this->dump(true)->shouldReturn('true (boolean)');
        $this->dump(null)->shouldReturn('null');
        
    }
    
    private function testSingle($tested, $expected, $dumper)
    {
        $dumper->dump($tested)->willReturn($expected);
        $this->dump($tested)->shouldReturn($expected);
    }
    private function testSingleNested($tested, $expected, $dumper)
    {
        $dumper->dump($tested, 0)->willReturn($expected);
        $this->dump($tested)->shouldReturn($expected);
    }
}
