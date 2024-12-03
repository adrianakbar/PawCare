<?php

namespace App\Services;

use App\Models\MethodPerformance;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use ReflectionMethod;

class CallGraphService
{
    // Metode untuk mengumpulkan performa method
    public function collectMethodPerformance()
    {
        $controllers = $this->getControllers();

        foreach ($controllers as $controller) {
            $methods = $this->getControllerMethods($controller);

            foreach ($methods as $method) {
                $this->trackMethodPerformance($controller, $method);
            }
        }
    }

    // Dapatkan daftar semua controller
    private function getControllers()
    {
        $controllerPath = app_path('Http/Controllers');
        $controllers = [];

        foreach (glob($controllerPath . '/*.php') as $file) {
            $controller = basename($file, '.php');
            $namespace = "App\\Http\\Controllers\\{$controller}";
            $controllers[] = $namespace;
        }

        return $controllers;
    }

    // Ambil metode dalam controller
    private function getControllerMethods($controllerClass)
    {
        $reflection = new ReflectionClass($controllerClass);
        return array_filter(
            $reflection->getMethods(ReflectionMethod::IS_PUBLIC),
            fn($method) => $method->getDeclaringClass()->getName() === $controllerClass
        );
    }

    // Lacak performa method
    private function trackMethodPerformance($controllerClass, $method)
    {
        // Simulasi tracking dengan data dummy
        $performance = MethodPerformance::updateOrCreate([
            'controller_name' => class_basename($controllerClass),
            'method_name' => $method->getName()
        ], [
            'total_calls' => rand(1, 20),
            'avg_execution_time' => rand(10, 500), // ms
            'memory_usage' => rand(100, 5000), // KB
            'last_called_at' => now()
        ]);
    }

    // Reduksi graph dengan kriteria kompleks
    public function reduceCallGraph($threshold = 5)
    {
        $criticalMethods = MethodPerformance::criticalMethods($threshold)
            ->get()
            ->map(function ($method) {
                return [
                    'controller' => $method->controller_name,
                    'method' => $method->method_name,
                    'performance_score' => $this->calculatePerformanceScore($method),
                    'total_calls' => $method->total_calls,
                ];
            })
            ->sortByDesc('performance_score')
            ->take(10); // Ambil 10 method terbaik

        return $criticalMethods;
    }

    // Hitung skor performa method
    private function calculatePerformanceScore($method)
    {
        return ($method->total_calls * 0.5) +
            (1 / $method->avg_execution_time * 100) +
            (1 / $method->memory_usage * 1000);
    }
}
