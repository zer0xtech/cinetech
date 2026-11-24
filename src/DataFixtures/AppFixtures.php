<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\Zerox;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
            $movie->setSynopsis($faker->text(200));
            $movie->setDateSortie($faker->dateTimeBetween('-40 years', 'now'));
            $movie->setDuree($faker->numberBetween(85, 180));
            $movie->setNotePresse($faker->numberBetween(0, 5));
            
            $randomCategory = $faker->randomElement($categories);
            $movie->setGenre($randomCategory);

            $manager->persist($movie);
        }
        
        $admin = new Zerox();
        $admin->setEmail('admin@cinetech.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        $user = new Zerox();
        $user->setEmail('user@cinetech.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        $manager->flush();
    }

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}
}