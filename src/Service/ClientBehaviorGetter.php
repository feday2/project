<?php

namespace App\Service;

use App\Service\Behaviors\ClientBehavior;
use App\Service\Behaviors\ClientBehaviorInterface;
use App\Service\Behaviors\UpdateActionStrategy;
use Symfony\Component\HttpFoundation\RequestStack;
use UAParser\Parser;

class ClientBehaviorGetter
{
    private $isMobile = false;
    private $userClient;
    private $supportBrowsers;
    private $supportMobile;

    public function __construct(RequestStack $requestStack, array $supported)
    {
        $this->supportBrowsers = $supported['browsers'];
        $this->supportMobile = $supported['mobile'];
        $userAgent = $requestStack->getCurrentRequest()->headers->get('User-Agent');
        $this->userClient = (Parser::create())->parse($userAgent);
        $client = \strtolower($this->userClient->ua->family);
        if (\strpos($client, 'mobile')) {
            $this->isMobile = true;
        }
    }

    public function getClientBehavior(): ClientBehaviorInterface
    {
        $client = \strtolower($this->userClient->ua->family);
        $supported = $this->isSupport($client);

        $updateStrategy = new UpdateActionStrategy();
        $updateAction = $updateStrategy->getUpdateAction($client);
        return new ClientBehavior($supported, $updateAction);
    }

    private function isSupport($client)
    {
        if ($this->isMobile && !$this->supportMobile) {
            return false;
        }
        if ( \array_key_exists($client, $this->supportBrowsers) ) {
            return $this->checkVersionCompatibility($this->supportBrowsers[$client], $this->userClient->ua->major);
        }
        return false;
    }

    private function checkVersionCompatibility($supVer, $clientVer)
    {
        if ($clientVer >= $supVer) {
            return true;
        }
        return false;
    }
}