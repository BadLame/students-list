<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class AuthByCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session("authenticated"))
            return $next($request);

        $token = $request->cookie("token", false);
        $student = null;
        if ($token)
            $student = Student::where("token", $token)->first()->toArray();

        session([
            "student" => $student,
            "authenticated" => !empty($student)
        ]);

        return $next($request);
    }
}
