<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

//记录程序执行时间
class Benchmark
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //前置
        $sTime = microtime(true);

        $response = $next($request);

        //后置
        $runtime = microtime(true) - $sTime;

        //记录到日志
        Log::info('benchmark',[
            'url'=>$request->user(),
            'input'=>$request->input(),
            'time'=>"{$runtime} ms"
        ]);

        return $response;
    }
}
