<?php namespace Tchannel\LpSolver;

use Exception;

class Solution
{
    protected $statuses = [
        "-2" => "NOMEMORY",
        "0" => "OPTIMAL",
        "1" => "SUBOPTIMAL",
        "2" => "INFEASIBLE",
        "3" => "UNBOUNDED",
        "4" => "DEGENERATE",
        "5" => "NUMFAILURE",
        "6" => "USERABORT",
        "7" => "TIMEOUT",
        "9" => "PRESOLVED",
        "10" => "PROCFAIL",
        "11" => "PROCBREAK",
        "12" => "FEASFOUND",
        "13" => "NOFEASFOUND"
    ];

    protected $status;
    protected $variables;
    protected $code;

    public function __construct($stat_code, $variables)
    {
        $this->parseStatus($stat_code);
        $this->variables = $variables;
    }


    protected function parseStatus($stat)
    {
        if (!isset($this->statuses[(string) $stat])) {
            throw new Exception("Unknown solver status code: {$stat}");
        }
        $this->code = $stat;
        $this->status = $this->statuses[(string) $stat];
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getCode()
    {
        return $this->code;
    }
}
