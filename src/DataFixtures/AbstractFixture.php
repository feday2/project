<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

abstract class AbstractFixture extends Fixture
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
