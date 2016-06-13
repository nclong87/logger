<?php
namespace LongNC;

class Logger {

    public function info($data) {
        $class = debug_backtrace()[1]['class'];
        $function = debug_backtrace()[1]['function'];
        \Monolog\Logger::info("$class\t$function".$this->getLogMessage($data));
    }

    public function error($data) {
        $class = debug_backtrace()[1]['class'];
        $function = debug_backtrace()[1]['function'];
        \Monolog\Logger::error("$class\t$function".$this->getLogMessage($data));
    }
    
    public function exception(\Exception $exc, $bPrintStackTrace = false) {
        \Monolog\Logger::error($exc->getMessage());
        if ($bPrintStackTrace == true) {
            \Monolog\Logger::error($exc->getTraceAsString());
        }
    }

    private function getLogMessage($data) {
        if (is_array($data)) {
            $message = json_encode($data);
        } else {
            $message = $data;
        }
        return  "\t{$message}";
    }
    
}
