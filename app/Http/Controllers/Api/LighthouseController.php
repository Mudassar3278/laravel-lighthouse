<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LighthouseController extends Controller
{
    public function getPerformanceScore(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'platform' => 'required|in:mobile,desktop',
        ]);

        $response = Http::get(config('app.lighthouse_api_url'), [
            'url' => $request->input('url'),
            'strategy' => $request->input('platform')
        ]);

        return response()->json([
            'performance_score' => $response['lighthouseResult']['categories']['performance']['score'] * 100,
        ]);
    }
}
