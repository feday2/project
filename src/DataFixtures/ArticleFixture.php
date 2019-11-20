<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class ArticleFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; ++$i) {
            $title = \ucfirst($this->faker->words($this->faker->numberBetween(3, 5), true));
            $article = new Article($title);

            $category = $this->getReference($this->faker->randomElement(\array_keys(CategoryFixture::CATEGORIES)));
            $description = \ucfirst($this->faker->words($this->faker->numberBetween(4, 8), true));
            $article
                ->setCategory($category)
                ->setDescription($description)
                ->setImage($this->faker->imageUrl())
            ;

            $body = '';
            $sentences = $this->faker->numberBetween(8, 20);

            for ($j = 0; $j < $sentences; ++$j) {
                $body .= '<p>'
                    .$this->faker->words($this->faker->numberBetween(4, 8), true)
                    .'</p>'
                ;
            }

            $article->setBody($body);

            if ($this->faker->boolean(80)) {
                $article->publish();
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [CategoryFixture::class];
    }
}
