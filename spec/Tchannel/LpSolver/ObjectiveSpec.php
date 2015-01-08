<?php

namespace spec\Tchannel\LpSolver;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tchannel\LpSolver\Coefficient;

class ObjectiveSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tchannel\LpSolver\Objective');
    }

    public function it_can_add_coefficients(Coefficient $coeff)
    {
        $this->addCoefficient($coeff);
        $this->count()->shouldBe(1);
    }

    public function it_can_get_coefficient_values(Coefficient $c1, Coefficient $c2)
    {
        $c1->getValue()->willReturn(20);
        $c2->getValue()->willReturn(30);
        $this->addCoefficient($c1);
        $this->addCoefficient($c2);

        $this->asCoefficients()->shouldBe([20, 30]);
    }

    public function it_can_get_coefficient_int_settings(Coefficient $c1, Coefficient $c2, Coefficient $c3)
    {
        $c1->getIsInt()->willReturn(false);
        $c2->getIsInt()->willReturn(true);
        $c3->getIsInt()->willReturn(false);

        $this->addCoefficient($c1);
        $this->addCoefficient($c2);
        $this->addCoefficient($c3);

        $this->asIntSettings()->shouldBe([0, 1, 0]);
    }
}
