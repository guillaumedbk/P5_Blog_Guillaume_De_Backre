<?php

namespace App\Repository;

use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class FileLogger extends LogLevel implements LoggerInterface
{
    public const LEVEL = [self::EMERGENCY, self::ALERT, self::CRITICAL, self::ERROR, self::WARNING, self::NOTICE, self::INFO, self::DEBUG];
    private $handle;

    public function __construct(string $file)
    {
        $this->handle = fopen($file, "a+");
    }
    public function __destruct()
    {
        fclose($this->handle);
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::EMERGENCY, $message, $context);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::ALERT, $message, $context);
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::ERROR, $message, $context);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::WARNING, $message, $context);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::NOTICE, $message, $context);
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::INFO, $message, $context);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        $this->log(self::DEBUG, $message, $context);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        if (in_array($level, self::LEVEL)) {
            $newMessage = $message;
            foreach ($context as $key=>$val) {
                str_replace('{'.$key.'}', $val, $newMessage);
            }
            $log = sprintf("%s [%s] - %s", date('Y-m-d H:i:s'), strtoupper($level), $newMessage.PHP_EOL);
            fwrite($this->handle, $log);
        } else {
            throw new InvalidArgumentException("Log level invalid");
        }
    }
}
