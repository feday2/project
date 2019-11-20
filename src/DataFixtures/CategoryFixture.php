<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

final class CategoryFixture extends AbstractFixture
{
    public const CATEGORIES = [
        'world' => 'World',
        'sport' => 'Sport',
        'it' => 'IT',
        'science' => 'Science',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $slug => $title) {
            $category = new Category($title);

            $manager->persist($category);

            $this->addReference($slug, $category);
        }

        $manager->flush();
    }
}
