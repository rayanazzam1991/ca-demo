<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function getLogs()
    {
        $logFilePath = storage_path('logs/laravel.log'); // Change the path if necessary

        if (File::exists($logFilePath)) {
            $logContents = File::get($logFilePath);
            return response()->json(['log' => $logContents]);
        } else {
            return response()->json(['error' => 'Log file not found'], 404);
        }
    }
    public function emptyLog(){

        $logFilePath = storage_path('logs/laravel.log'); // Change the path if necessary

        if (File::exists($logFilePath)) {
            File::delete($logFilePath);
            return response()->json(['message' => 'Log file deleted']);
        } else {
            return response()->json(['error' => 'Log file not found'], 404);
        }
    }


}
