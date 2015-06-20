<?php
// src/Bajor/WebServiceBundle/Services/HelloService.php
namespace Bajor\WebServiceBundle\Services;

class HelloService
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function hello($name)
    {

        $message = \Swift_Message::newInstance()
                                ->setTo('przemek.piatek@gmail.com')
                                ->setSubject('Hello Service')
                                ->setBody($name . ' says hi!');

        $this->mailer->send($message);

        return 'Hello, '.$name;
    }
}