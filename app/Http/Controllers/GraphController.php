<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CallGraphService;

class GraphController
{
    protected $callGraphService;

    public function __construct(CallGraphService $callGraphService)
    {
        $this->callGraphService = $callGraphService;
    }

    public function index()
    {
        $criticalMethods = $this->callGraphService->reduceCallGraph()->toArray();

        return view('call_graph', [
            'criticalMethods' => $criticalMethods
        ]);
    }
}
