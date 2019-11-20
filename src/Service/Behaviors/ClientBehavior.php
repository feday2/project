<?php

namespace App\Service\Behaviors;

class ClientBehavior implements ClientBehaviorInterface
{

    private $supported;
    private $updateAction;
    
    public function __construct(bool $supported, $updateAction = null)
    {
        $this->supported = $supported;
        $this->updateAction = $updateAction;
    }

    public function isSupported(): bool
    {
        return $this->supported;
    }

    public function getUpdateAction(): ?UpdateActionInterface
    {
        return $this->updateAction;
    }

}