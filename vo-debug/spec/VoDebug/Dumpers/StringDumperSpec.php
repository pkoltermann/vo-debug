<?php

namespace spec\VoDebug\Dumpers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringDumperSpec extends ObjectBehavior
{
    function it_should_implement_dumper()
    {
        $this->shouldHaveType('VoDebug\Dumpers\Dumper');
    }
    
    public function it_should_escape_and_dump_String_content()
    {
        $this->dump("foobar")->shouldReturn("'foobar' (string)");
        $this->dump('123')->shouldReturn("'123' (string)");
        $this->dump('!@#$%^&*(.,/\'"')->shouldReturn("'!@#$%^&amp;*(.,/'&quot;' (string)");
    }
}
