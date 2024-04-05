<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center"><a href="https://www.rabbitmq.com/" target="_blank"><img src="https://www.rabbitmq.com/img/rabbitmq-logo-with-name.svg" width="400" alt="RabbitMQ Logo"></a></p>


<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup

This testing run with Laravel 10x. And installtion below,

- if you are using mac then 
type $ brew install rabbitmq
then export path to rabbit mq commands
then enable rabbit management 
type $ rabbitmq-plugins enable rabbitmq_management
then start rabbit mq server to use rabbit mq system
type rabbitmq-server
then you can call http://localhost:15672 in your local
then you need to make sure you have installed. Read the guide [amqp](https://pecl.php.net/package/amqp)
then enable in your php.ini which is currently active version.
then restart the php

then  you have to install composer library for rabbit mq

- $ composer require php-amqplib/php-amqplib  ( for AMQP Protocool )
- $ composer require enqueue/amqp-bunny ( to interact with rabbit mq queue in php)

then check the rabbit mq queue 
type $ php artisan rabbitmq:consume


then you run php artisan schedule:run by manual or using cronjob 

Thank you for paying attention
