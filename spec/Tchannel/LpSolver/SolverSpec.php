<?php

namespace spec\Tchannel\LpSolver;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tchannel\LpSolver\Constraint;
use Tchannel\LpSolver\Coefficient;
use Tchannel\LpSolver\Objective;

class SolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tchannel\LpSolver\Solver');
    }


    function it_correctly_builds_and_executes_a_solver()
    {
        $obj = $this->getObjective();
        $obj->setType(Objective::TYPE_MAXIM);

        $this->addCoefficient(new Coefficient(-2, true))
            ->addCoefficient(new Coefficient(5, true))
            ->addConstraint(new Constraint([1, 0], Constraint::GREATER, 100))
            ->addConstraint(new Constraint([1, 0], Constraint::LESS, 200))
            ->addConstraint(new Constraint([0, 1], Constraint::GREATER, 80))
            ->addConstraint(new Constraint([0, 1], Constraint::LESS, 170))
            ->addConstraint(new Constraint([1, 1], Constraint::GREATER, 200));

        $solution = $this->solve();
        $solution->getStatus()->shouldBe('OPTIMAL');
    }
}
