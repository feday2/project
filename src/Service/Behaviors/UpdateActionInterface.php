<?php

namespace App\Service\Behaviors;

interface UpdateActionInterface
{
    public function getMessage(): string;
    public function getLink(): ?string;
}