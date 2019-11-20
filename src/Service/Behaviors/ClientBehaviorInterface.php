<?php

namespace App\Service\Behaviors;

interface ClientBehaviorInterface
{
    public function isSupported(): bool;
    public function getUpdateAction(): ?UpdateActionInterface;
}