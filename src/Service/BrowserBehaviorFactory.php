<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class BrowserBehaviorFactory
{

    private $browser;

    public function __construct(RequestStack $requestStack)
    {
        $this->browser = $requestStack;
    }

    public function getBrowser() 
    {
        dump($this->browser);
    }
}