<?php

namespace Sopra\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class FileLoggerAvecTrait implements LoggerInterface
{
    use LoggerTrait;
    /**
     * @var resource
     */
    protected $fic;

    public function __construct($filePath)
    {
        $this->fic = fopen($filePath, 'a');
    }

    public function __destruct()
    {
        fclose($this->fic);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        // [error] 2015-10-12 13:58:23 - Une erreur s'est produite

        $date = date('Y-m-d H:i:s');
        $logMsg = "[$level] $date - $message\n";
        fwrite($this->fic, $logMsg);
    }
}