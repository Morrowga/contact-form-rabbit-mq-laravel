<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQ
{
    //rabbit mq connection
    //rabbit mq channel
    //rabbit mq exchange
    //rabbit mq route
    protected $connection;
    protected $channel;
    protected $exchange = 'contact';
    protected $routingKey = 'message_route';

    public function __construct()
    {
        //Set up Rabbit MQ Connection

        //rabbit mq host
        //rabbit mq port
        //rabbit mq login
        //rabbit mq password
        //rabbit mq virtual host

        $this->host = env('RABBITMQ_HOST');
        $this->port = env('RABBITMQ_PORT');
        $this->login = env('RABBITMQ_LOGIN');
        $this->password = env('RABBITMQ_PASSWORD');
        $this->vhost = env('RABBITMQ_VHOST');
    }

    //Creating Connection for Rabbit MQ

    public function createConnection()
    {
        //Insert Stream Connection for Rabbit MQ

        $this->connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->login,
            $this->password,
            $this->vhost
        );

        $this->channel = $this->connection->channel();

        //set exchange in rabbit mq
        $this->channel->exchange_declare($this->exchange, 'direct', false, true, false);
        //set queue in rabbit mq
        $this->channel->queue_declare(env('RABBITMQ_QUEUE'), false, true, false, false);
        //set queue bind with route in rabbit mq
        $this->channel->queue_bind(env('RABBITMQ_QUEUE'), $this->exchange, $this->routingKey);
    }

    //publishing message to rabbit mq

    public function publish($message)
    {
        $msg = new AMQPMessage($message);

        $this->channel->basic_publish($msg, $this->exchange, $this->routingKey);
    }

    //consuming message to rabbit mq
    public function consume($callback)
    {
        $this->channel->basic_consume(env('RABBITMQ_QUEUE'), '', false, false, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    //close rabbit mq connection
    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }

}
