<?php namespace Tchannel\LpSolver;

class Solver
{
    protected $type;
    protected $constraints = [];
    protected $objective;

    public function __construct(Objective $objective = null)
    {
        if (!$objective) {
            $this->objective = new Objective;
        } else {
            $this->objective = $objective;
        }
    }

    public function getObjective()
    {
        return $this->objective;
    }


    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
        return $this;
    }

    public function addCoefficient(Coefficient $coeff)
    {
        $this->objective->addCoefficient($coeff);
        return $this;
    }

    public function solve()
    {
        $lp = lpsolve('make_lp', 0, $this->objective->count());
        lpsolve('set_verbose', $lp, IMPORTANT);
        lpsolve('set_obj_fn', $lp, $this->objective->asCoefficients());

        foreach ($this->constraints as $c) {
            lpsolve('add_constraint', $lp, $c->getCoefficients(), $c->getComparison(), $c->getRhs());
        }

        foreach ($this->objective->getCoefficients() as $index => $coeff) {
            if ($coeff->hasUpperBound()) {
                lpsolve('set_upbo', $lp, $index+1, $coeff->getUpperBound());
            }
            if ($coeff->hasLowerBound()) {
                lpsolve('set_lowbo', $lp, $index+1, $coeff->getLowerBound());
            }
        }


        lpsolve('set_int', $lp, $this->objective->asIntSettings());
        lpsolve($this->objective->getType(), $lp);

        $stat = lpsolve('solve', $lp);

        return new Solution($stat, lpsolve('get_variables', $lp));
        #dd([$stat, lpsolve('get_variables', $lp)]);
    }
}
