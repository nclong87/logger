<?php
namespace LongNC;

class Logger extends \Monolog\Logger{

    public function info($data) {
        $class = debug_backtrace()[1]['class'];
        $function = debug_backtrace()[1]['function'];
        parent::info("$class\t$function".$this->getLogMessage($data));
    }

    public function error($data) {
        $class = debug_backtrace()[1]['class'];
        $function = debug_backtrace()[1]['function'];
        parent::error("$class\t$function".$this->getLogMessage($data));
    }
    
    public function exception(\Exception $exc, $bPrintStackTrace = false) {
        parent::error($exc->getMessage());
        if ($bPrintStackTrace == true) {
            parent::error($exc->getTraceAsString());
        }
    }

    function getCorrelation_id() {
        return $this->correlation_id;
    }

    function setCorrelation_id($correlation_id) {
        $this->correlation_id = $correlation_id;
    }

    public function genCorrelationId() {
        $this->correlation_id = date('YmdHis') . sprintf('%06d', rand(1, 999999));
    }

    private function getLogMessage($data) {
        if (is_array($data)) {
            $message = json_encode($data);
        } else {
            $message = $data;
        }
        return "\t{$this->correlation_id}\t{$message}";
    }
    
}
