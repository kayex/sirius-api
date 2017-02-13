<?php
namespace App\Helpers;

// Core
use Log;
use Config;

// Exceptions
use App\Exceptions\MQTTException;

// MQTT
use Library\MQTT as MQTTClient;

class MQTT
{
    private $conn;

    public function __construct(
        string $host,
        string $port,
        string $clientId,
        $user = null,
        $password = null
    ) {
        $this->conn = new MQTTClient($host, $port, $clientId);

        if (!$this->conn->connect(true, null, $user, $password)) {
            throw MQTTException::connectionFailed($host, $port);
        }
    }

    public function publish(string $topic, string $message)
    {
            $this->conn->publish($topic, $message);
            Log::debug("MQTT publish: $message");
    }
}