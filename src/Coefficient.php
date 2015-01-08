<?php namespace Tchannel\LpSolver;


class Coefficient
{
    protected $lower_bound = null;
    protected $upper_bound = null;
    protected $is_int = false;
    protected $name = null;
    protected $value;


    public function __construct($value, $is_int = true, $low = null, $high = null, $name = null)
    {
        $this->value = $value;
        $this->setIsInt($is_int);
        $this->setLowerBound($low);
        $this->setUpperBound($high);
        $this->name = $name;
    }


    public function getValue()
    {
        return $this->value;
    }


    public function setIsInt($isint)
    {
        $this->is_int = $isint;
        return $this;
    }

    public function getIsInt()
    {
        return $this->is_int;
    }

    public function setLowerBound($bound)
    {
        $this->lower_bound = $bound;
        return $this;
    }

    public function getLowerBound()
    {
        return $this->lower_bound;
    }

    public function hasLowerBound()
    {
        return !is_null($this->lower_bound);
    }

    public function setUpperBound($bound)
    {
        $this->upper_bound = $bound;
        return $this;
    }

    public function getUpperBound()
    {
        return $this->upper_bound;
    }

    public function hasUpperBound()
    {
        return !is_null($this->upper_bound);
    }
}
