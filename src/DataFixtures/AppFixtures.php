<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use EsperoSoft\Faker\Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();

        $users = [];
        for ($i = 0; $i < 15; $i++) {
            $user = new User();
            $user->setFullName($faker->full_name())
                ->setMatricule($faker->email())
                ->setPassword(sha1("test"))
                ->setCreatedAt($faker->dateTimeImmutable());

            $users[] = $user;
            $manager->persist($user);
        }

        for ($i = 0; $i < 300; $i++) {
            $event = new Event();
            $event->setTitle($faker->description(30))
                ->setCreatedAt($faker->dateTimeImmutable())
                ->setDescription($faker->description(60))
                ->setUser($users[rand(0, count($users) - 1)]);

            $manager->persist($event);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
