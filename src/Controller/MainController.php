<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ClientBehaviorGetter;
use App\Service\WorkingTimeService;

class MainController extends AbstractController
{

    private $clientBehavior;
    private $isWorkTime;

    public function __construct(ClientBehaviorGetter $clientBehaviorGetter, WorkingTimeService $workingTimeService)
    {
        $this->clientBehavior = $clientBehaviorGetter->getClientBehavior();
        $this->isWorkTime = $workingTimeService->isWorkTime();
    }

    public function char()
    {
        // dump(date('N', strtotime('Monday')));
        $userClient = $this->clientBehavior;
        return $this->render('index.html.twig', [
            "char" => "a",
            "userClient" => $userClient,
            "isWorkTime" => $this->isWorkTime,
        ]);
    }
}
