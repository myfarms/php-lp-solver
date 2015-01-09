<?php

namespace spec\Tchannel\LpSolver;

use Tchannel\LpSolver\Constraint;
use Illuminate\Support\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConstraintSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([], Constraint::GREATER, 5);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tchannel\LpSolver\Constraint');
    }


    function it_can_delete_itself()
    {
        $coll = new Collection;
        $coll->push($this);

        $this->setOwner($coll);

        expect($coll->count())->shouldBe(1);
        $this->remove()->shouldBe($coll);

        expect($coll->count())->shouldBe(0);
    }
}
