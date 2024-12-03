<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MethodPerformance extends Model
{
    protected $table = 'method_performances';

    protected $fillable = [
        'controller_name',
        'method_name',
        'total_calls',
        'avg_execution_time',
        'memory_usage',
        'last_called_at'
    ];

    // Scope untuk metode kritis
    public function scopeCriticalMethods($query, $threshold = 5)
    {
        return $query->where('total_calls', '>=', $threshold)
            ->orderBy('avg_execution_time', 'desc');
    }
}
