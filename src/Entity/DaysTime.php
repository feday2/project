<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DaysTimeRepository")
 */
class DaysTime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $weekDay;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $start;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekDay(): ?int
    {
        return $this->weekDay;
    }

    public function setWeekDay(int $weekDay): self
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    public function setEnd(string $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "weekDay" => $this->weekDay,
            "start" => $this->timeToArray($this->start),
            "end" => $this->timeToArray($this->end),
        ];
    }

    private function timeToArray(string $stringTime): array
    {
        return explode(":", $stringTime);
    }
}
