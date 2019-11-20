<?php

namespace App\Service\Behaviors;

class UpdateAction implements UpdateActionInterface
{

    private $message;
    private $link;

    public function __construct($message = '', $link = '')
    {
        $this->message = $message;
        $this->link = $link;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}