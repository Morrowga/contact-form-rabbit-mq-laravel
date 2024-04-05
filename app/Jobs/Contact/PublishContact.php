<?php

namespace App\Jobs\Contact;

use App\Services\RabbitMQ;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PublishContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $formData;

    /**
     * Create a new job instance.
     */
    public function __construct($formData)
    {
        // get form data from incoming request
        $this->formData = $formData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //initiate the rabbit mq service
        $rabbitMQ = new RabbitMQ();

        //create rabbit mq connection
        $rabbitMQ->createConnection();

        //publishing data to rabbit mq connection
        $rabbitMQ->publish(json_encode($this->formData));

        //close rabbit mq connection
        $rabbitMQ->closeConnection();
    }
}
