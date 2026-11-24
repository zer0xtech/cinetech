<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categoryNames = ['Science-Fiction', 'Action', 'Thriller', 'Comédie', 'Drame'];
        $categories = [];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            
            $manager->persist($category);
            $categories[] = $category;
        }

        // 2. Création des 30 films réalistes
        for ($i = 0; $i < 30; $i++) {
            $movie = new Movie();
            
            $movie->setTitre($faker->sentence(3));
            $movie->setSynopsis($faker->paragraph(3));
            $movie->setDateSortie($faker->dateTimeBetween('-40 years', 'now'));
            $movie->setDurée($faker->numberBetween(85, 180));
            
            $randomCategory = $faker->randomElement($categories);
            $movie->setGenre($randomCategory);

            $manager->persist($movie);
        }

        $manager->flush();
    }
}