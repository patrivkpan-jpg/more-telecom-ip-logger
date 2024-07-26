<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AllowedIps;
use App\Models\AccessIps;
use App\Models\AccessLogs;
use Illuminate\Support\Facades\Log;

class EnsureAccessIsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $this->logAccess($ip);
        $allowedIps = AllowedIps::select('ip')
            ->where('allow', 1)
            ->get();
        $allowedIps = $allowedIps->pluck('ip')->all();
        if (in_array($ip, $allowedIps) && auth()->user() !== null) {
            return $next($request);
        }
        return response()->view('403');
    }

    private function logAccess($ip)
    {
        $accessIp = new AccessIps;
        $accessIp = AccessIps::firstOrNew(
            [
                'ip' => $ip
            ]
        );
        $accessIp->save();
        
        $logMessage = 'Someone tried to access from IP address ' . $ip;
        $userId = null;
        if (auth()->user() !== null) {
            $userId = auth()->user()->id;
            $logMessage = 'User "' . auth()->user()->name . '" accessed from IP address ' . $ip;
        }
        $accessIpId = $accessIp->id;
        $accessLog = new AccessLogs;
        $accessLog->user_id = $userId;
        $accessLog->access_ips_id = $accessIpId;
        $accessLog->save();

        Log::channel('access_logs')->info($logMessage);
    }
}
