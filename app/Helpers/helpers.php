<?php

use Illuminate\Support\Facades\Log;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('makeLog')) {
    /**
     * Custom log format.
     *
     * @param object $error Error object.
     * @param string $prefix Custom info log.
     * @param string $type Type of log: error, warning, debug... .
     * 
     * @return void
     * 
     */
    function makeLog(object $error, string $prefix = '', string $type = 'error'): void
    {
        $startlog = '----- Start log -----';;
        $endlog = '----- End log -----';
        if (!empty($prefix)) {
            $startlog = '----- ' . $prefix . ' ----- ';
            $endlog = '----- End ' . $prefix . ' ----- ';
        }
        Log::$type($startlog);
        Log::$type($error->getMessage());
        report($error);
        Log::$type($endlog);
    }
}
