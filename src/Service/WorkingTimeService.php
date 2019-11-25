<?php

namespace App\Service;

use App\Repository\DaysTimeRepository;
use App\Repository\ExcludeDaysTimeRepository;

class WorkingTimeService
{

    private $daysTimeRepo;
    private $excludeDaysTimeRepo;
    private $currentDateTime;

    public function __construct(DaysTimeRepository $daysTimeRepo, ExcludeDaysTimeRepository $excludeDaysTimeRepo)
    {
        $this->daysTimeRepo = $daysTimeRepo;
        $this->excludeDaysTimeRepo = $excludeDaysTimeRepo;
        $this->currentDateTime = new \DateTime();
    }

    public function isWork(){
        if ($this->timeToWork) {
            return true;
        }
        return false;
    }

    public function timeToWork()
    {
        $nextWork = $this->timeToStart();

        if ($nextWork) {
            $nextWork = $this->isExceptionWork($this->currentDateTime, $nextWork) ?? $this->getDiffTime($this->currentDateTime, $nextWork);
        }

        return $nextWork;
    }

    private function isExceptionWork($nextWork)
    {
        $excWork = $this->excludeDaysTimeRepo->findWorkDateBeetween($this->currentDateTime, $nextWork);
        foreach ( (array) $excWork as $excDate) {
            $startHour = explode(":", $excDate->getStart())[0];
            $startMin = explode(":", $excDate->getStart())[1];
            $startWork = clone $excDate->getDate()->setTime($startHour, $startMin);
            $endHour = explode(":", $excDate->getEnd())[0];
            $endMin = explode(":", $excDate->getEnd())[1];
            $endWork = clone $excDate->getDate()->setTime($endHour, $endMin);

            if ( $this->currentDateTime < $startWork ){
                return $this->getDiffTime($this->currentDateTime, $startWork);
            } elseif ($this->currentDateTime < $endWork) {
                return false;
            } 
        }
    }

    private function isExceptionHoliday($startWork)
    {
        $excHoliday = $this->excludeDaysTimeRepo->findOneBy([
            'date' => $startWork,
            'isWork' => 0,
        ]);
        if ($excHoliday) {
            return true;
        }
        return false;
    }

    private function timeToStart()
    {
        $curDay = $this->currentDateTime->format('N');
        for ($diff = 0; $diff <= 6; $diff++) {
            $nextDay = $curDay + $diff;
            if ($nextDay > 7) {
                $nextDay = $nextDay - 7;
            }
            $workDay = $this->daysTimeRepo->findOneBy(['weekDay' => $nextDay]);
            if ($workDay){
                $startWork = $this->workDateTime($diff, $workDay->getStart());
                $endWork = $this->workDateTime($diff, $workDay->getEnd());
                if ( !$this->isExceptionHoliday($startWork) ){
                    switch ($this->dateTimePosition($this->currentDateTime, $startWork, $endWork)) {
                        case 0:
                            return false;
                        case -1:
                            return $startWork;
                    }
                }
            }
        }
        return false;
    }

    private function getDiffTime($fromTime, $to)
    {
        return $fromTime->diff($to);
    }

    private function workDateTime(int $incDays, string $time)
    {
        $date = (new \DateTime())->modify('+'.$incDays.' day');
        return $date->setTime(explode(":", $time)[0], explode(":", $time)[1]);
    }

    private function dateTimePosition($dateTime, $leftDateTime, $rightDateTime) {
        if ($dateTime > $rightDateTime) {
            return 1;
        }
        if ($dateTime < $leftDateTime) {
            return -1;
        }
        return 0;
    }
}