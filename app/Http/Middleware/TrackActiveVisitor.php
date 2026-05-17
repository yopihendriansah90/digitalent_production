<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackActiveVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get') && ! $request->is('admin*')) {
            $sessionId = $request->session()->getId() ?: 'guest';
            $ip = (string) $request->ip();
            $userAgent = (string) $request->userAgent();
            $visitorKey = hash('sha256', $sessionId.'|'.$ip.'|'.$userAgent);

            DB::table('visitor_sessions')->updateOrInsert(
                ['visitor_key' => $visitorKey],
                [
                    'ip_address' => $ip,
                    'user_agent' => mb_substr($userAgent, 0, 500),
                    'last_path' => mb_substr((string) $request->path(), 0, 255),
                    'last_seen_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('visitor_sessions')
                ->where('last_seen_at', '<', now()->subDay())
                ->delete();
        }

        return $next($request);
    }
}
