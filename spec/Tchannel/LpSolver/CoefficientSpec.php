<?php

namespace spec\Tchannel\LpSolver;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CoefficientSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(20);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tchannel\LpSolver\Coefficient');
    }


    function it_can_have_an_upper_and_lower_bound()
    {
        $this->setLowerBound(50);
        $this->getLowerBound()->shouldBe(50);
        $this->setUpperBound(150);
        $this->getUpperBound()->shouldBe(150);
    }

    function it_can_confirm_bounds_are_set()
    {
        $this->hasUpperBound()->shouldBe(false);
        $this->setUpperBound(100);
        $this->hasUpperBound()->shouldBe(true);
    }


}
