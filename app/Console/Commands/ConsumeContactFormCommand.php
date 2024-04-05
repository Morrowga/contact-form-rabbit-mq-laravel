<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Mail\MailToOwner;
use App\Services\RabbitMQ;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ContactCreateRequest;
use Illuminate\Validation\ValidationException;

class ConsumeContactFormCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume-contact-form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume contact form data from RabbitMQ and process it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Set Log For Contact Saving
        \Log::info('Start Contact Saving');

        //initiate the rabbit mq service
        $rabbitMQ = new RabbitMQ();

        //create rabbit mq connection
        $rabbitMQ->createConnection();

        //consuming data to rabbit mq connection
        $rabbitMQ->consume(function ($msg){
            //inserting callback and get the message from rabbit my queue
            $result = $this->saveContact($msg->body);
            if($result)
            {
                //acknowledge the message from queue
                $msg->ack();
            }
        });

        //close rabbit mq connection
        $rabbitMQ->closeConnection();

        //Set Log for Contact Data saved successfully or not
        \Log::info('Contact saved successfully: ' . json_encode($data));
    }

    //saving contact data in database
    public function saveContact($data):bool
    {
        //deserialization contact data
        $decodeData = json_decode($data, true);

        try {

            //start validate the contact data
            $request = new ContactCreateRequest();

            $validator = Validator::make($decodeData, $request->rules());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            //end validate the contact data


            //create contact data in database;
            $contact = Contact::create($decodeData);

            //Mail to related owner of site.
            Mail::to('mr.alvin199818@gmail.com')->send(new MailToOwner($contact));

            //return bool for checking the saving process
            return true;

        } catch (ValidationException $e) {
            //Set Log For validation error
            \Log::error('Validation failed while saving contact: ' . $e->getMessage());

            return false;
        } catch (\Exception $e) {
            //Set Log For error
            \Log::error('Error occurred while saving contact: ' . $e->getMessage());

            return false;
        }
    }
}
