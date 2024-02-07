<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
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

        $listCategories = [
            'Intra-scolaire',
            'Sportive',
            'Visite',
            'Examen',
            'Foot',
            'Basket',
        ];

        $categories = [];

        for ($i = 0; $i < count($listCategories) - 1; $i++){
            $category = new Category();
            $category->setName($listCategories[rand(0, count($listCategories) - 1)])
                    ->setDescription($faker->description(20));
            $categories[] = $category;

            $manager->persist($category);
        }

//        $users = [];
//        for ($i = 0; $i < 15; $i++) {
//            $user = new User();
//            $user->setFullName($faker->full_name())
//                ->setMatricule('22G0'. $i)
//                ->setPassword(password_hash('test', PASSWORD_BCRYPT))
//                ->setCreatedAt($faker->dateTimeImmutable());
//
//
//            $users[] = $user;
//            $manager->persist($user);
//        }

//
//        $events = [];
//        for ($i = 0; $i < 100; $i++) {
//            $event = new Event();
//            $event->setTitle($faker->description(30))
//                ->setCreatedAt($faker->dateTimeImmutable())
//                ->setDescription($faker->description(60))
//                ->setUser($users[rand(0, count($users) - 1)])
//                ->setIsValid(0)
//                ->setStartAt($faker->dateTimeImmutable())
//                ->setEndAt($faker->dateTimeImmutable())
//                ->addCatEvent($categories[rand(0, count($categories) - 1)])
//                ->setIllustration($faker->image())
//                ->setSlug('test');
//
//            $events[] = $event;
//
//            $manager->persist($event);
//        }
//
//
//
//        $comments = [];
//        for ($i = 0; $i < 200; $i++ ){
//            $comment = new Comment();
//            $comment->setAuthor($users[rand(0, count($users) - 1)])
//                    ->setContent($faker->description(30))
//                    ->setCreatedAt($faker->dateTimeImmutable())
//                    ->setEvent($events[rand(0, count($events) - 1)]);
//
//            $manager->persist($comment);
//        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
