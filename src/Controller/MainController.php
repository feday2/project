<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ClientBehaviorGetter;

class MainController extends AbstractController
{

    private $clientBehavior;

    public function __construct(ClientBehaviorGetter $clientBehaviorGetter)
    {
        $this->clientBehavior = $clientBehaviorGetter->getClientBehavior();
    }

    public function char()
    {
        dump($this->clientBehavior);
        return $this->render('index.html.twig', [
            "char" => "a"
        ]);
    }
}
