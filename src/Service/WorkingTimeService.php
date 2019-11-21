<?php

namespace App\Service;

use App\Repository\DaysTimeRepository;
use App\Repository\ExcludeDaysTimeRepository;

class WorkingTimeService
{

    private $DaysTimeRepo;
    private $ExcludeDaysTimeRepo;

    public function __construct(DaysTimeRepository $DaysTimeRepo, ExcludeDaysTimeRepository $ExcludeDaysTimeRepo)
    {
        $this->DaysTimeRepo = $DaysTimeRepo;
        $this->ExcludeDaysTimeRepo = $ExcludeDaysTimeRepo;
    }

    public function isWorkTime()
    {
        $dayDiffCount = $this->getDayDiffCount();

        // $this->checkTime();

        dump($isWork);
        return true;
    }

    private function getDayDiffCount()
    {
        $curDay = date('N', time());
        // for () {

        // }
        $isWork = $this->DaysTimeRepo->findOneBy(['weekDay' => $curDay]);
    }
}