<?php

namespace App\Controllers;

use App\Logging\MeasurePerformance;
use Packages\Http\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        register_shutdown_function([$this, 'measurePerformance']);
    }

    public function measurePerformance()
    {
        $log = new MeasurePerformance([
            "execution_time" => round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 3),
            "memory_usage" => round((memory_get_usage() / 1024 / 1024), 2)
        ]);
        return $log->emit();
    }
}
