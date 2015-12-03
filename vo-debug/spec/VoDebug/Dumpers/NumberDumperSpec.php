<?php

namespace spec\VoDebug\Dumpers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberDumperSpec extends ObjectBehavior
{
    public function it_should_dump_number_content()
    {
        $this->dump(0.23)->shouldReturn("0.23 (number)");
        $this->dump(123)->shouldReturn("123 (number)");
        $this->dump(1.23)->shouldReturn("1.23 (number)");
        $this->dump(0.23)->shouldReturn("0.23 (number)");
        $this->dump(0.23)->shouldReturn("0.23 (number)");
        $this->dump(0.23)->shouldReturn("0.23 (number)");
    }
}
