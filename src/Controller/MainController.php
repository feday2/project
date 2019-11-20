<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BrowserBehaviorFactory;

class MainController extends AbstractController
{

    public function __construct(BrowserBehaviorFactory $browserFactory)
    {
        $this->browser = $browserFactory->getBrowser();
    }

    public function char()
    {
        return $this->render('index.html.twig', [
            "char" => "a"
        ]);
    }
}
