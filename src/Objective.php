<?php namespace Tchannel\LpSolver;

use Illuminate\Support\Collection;
use Exception;

class Objective
{
    protected $coefficients;
    protected $type;
    const TYPE_MAXIM = 'set_maxim';
    const TYPE_MINIM = 'set_minim';

    public function __construct($type = null)
    {
        $this->setType($type);
        $this->coefficients = new Collection;
    }

    public function count()
    {
        return $this->coefficients->count();
    }


    public function setType($type = null)
    {
        if (!$type) {
            $this->type = static::TYPE_MINIM;
        } else {
            if ($type != static::TYPE_MINIM && $type != static::TYPE_MAXIM) {
                throw new Exception("Objective type must be either Objective::TYPE_MINIM or Objective::TYPE_MAXIM");
            }

            $this->type = $type;
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCoefficient($index)
    {
        $this->coefficients->get($index);
    }

    public function getCoefficients()
    {
        return $this->coefficients->all();
    }


    public function addCoefficient(Coefficient $coefficient)
    {
        $this->coefficients->push($coefficient);
    }


    public function asCoefficients()
    {
        $cfs = $this->coefficients->map(function ($elem) {
            return $elem->getValue();
        });

        return $cfs->all();
    }

    public function asIntSettings()
    {
        $cfs = $this->coefficients->map(function ($elem) {
            return $elem->getIsInt() ? 1 : 0;
        });

        return $cfs->all();
    }
}
