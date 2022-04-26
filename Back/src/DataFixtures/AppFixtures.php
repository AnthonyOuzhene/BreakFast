<?php

namespace App\DataFixtures;

use App\Entity\Bakery;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        // Création des utilisateurs Admin et Partner
        $user = new User();
        $user->setEmail('admin@breakfast.com');
        $user->setAddress($faker->address());
        $user->setName($faker->name());
        $user->setZipCode($faker->randomNumber(5, true));
        $user->setPassword('$2y$13$A/CUvaxJfGqkKZhZ2TfiHOA0q4hlDhDmMkMRXMaNLLs7wcaXkhQZ2');
        // password is admin
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('partner@breakfast.com');
        $user->setAddress($faker->address());
        $user->setName($faker->name());
        $user->setZipCode($faker->randomNumber(5, true));
        $user->setPassword('$2y$13$QB45Fst6jM6r7vb77aX8Ie6VckkyJCW.Ollgm5oZ/ehmEwff.sNmO');
        // password is partner
        $user->setRoles(['ROLE_PARTNER']);

        $manager->persist($user);

        // Liste des catégories stockée dans un tableau
        $categories = [
            'gâteaux',
            'viennoiseries',
            'snacks',
            'pain',
            'boissons_fraîches',
            'boissons_chaudes',
            'bonbons',
        ];

        // Contient les objets des catégories crée
        $categoryObjects = [];

        // parcourir le tableau des categories
        foreach ($categories as $currentCategory) {
            $category = new Category();
            $category->setName($currentCategory);

            $categoryObjects[] = $category;
            $manager->persist($category);
        }

        // Liste des boulangeries aléatoires avec faker
        $bakeryNumber = 15;
        $bakeryObjects = [];

        // Boucle pour créer le nombre de boulangeries demandées
        for ($i = 0; $i < $bakeryNumber; $i++) {
            $bakery = new Bakery();
            $bakery->setName($faker->name());
            $bakery->setAddress($faker->address());
            $bakery->setProfileImg('https://picsum.photos/id/' . ($i + 1) . '/200/300');
            $bakery->setPhoneNumber($faker->randomNumber(9, true));
            $bakery->setRating($faker->numberBetween(0, 5));
            $bakery->setStatus($faker->numberBetween(0, 1));
            $bakery->setDeliveryFees($faker->randomFloat(2, 0, 5));
            $bakery->setDeliveryTime($faker->numberBetween(1, 30));
            $bakery->setUser($user);

            $bakeryObjects[] = $bakery;
            $manager->persist($bakery);
        }

        // Liste des products
        $productNumber = 30;
        $productObjects = [];

        for ($i = 0; $i < $productNumber; $i++) {
            $product = new Product;
            $product->setName($faker->word());
            $product->setPrice($faker->randomFloat(2, 0, 10));
            $product->setDescription($faker->realText(150));
            $product->setPicture('https://picsum.photos/id/' . ($i + 1) . '/200/300');
            $product->setBakery($bakery);
            $product->setCategory($category);

            $productObjects[] = $product;
            $manager->persist($product);
        }

        // Liste des tags stockée dans un tableau
        $tags = [
            'bio',
            'vegan',
            'sans_gluten',
            'anniversaire',
        ];

        // Contient les objets des tags crée
        $tagObjects = [];

        // Parcourir le tableau des tags
        foreach ($tags as $currentTag) {
            $tag = new Tag();
            $tag->setName($currentTag);

            $tagObjects[] = $tag;
            $manager->persist($tag);
        }

        // Création des Orders
        $orderNumber = 10;
        $orderObjects = [];

        for ($i = 0; $i < $orderNumber; $i++) {
            $order = new Order;
            $order->setTotalPrice($faker->randomFloat(2, 1, 100));
            $order->setOrderDate(new DateTime());
            $order->setUser($user);

            $orderObjects[] = $order;
            $manager->persist($order);
        }

        $manager->flush();
    }
}
