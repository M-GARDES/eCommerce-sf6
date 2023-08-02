<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker; 

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('moi@gmaill.com');
        $admin->setLastname('Dupon');
        $admin->setFirstname('marie');
        $admin->setAddress('3 rue du bois');
        $admin->setZipcode('30100');
        $admin->setCity('Alès');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, "Motpasse")
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr=1; $usr<=5; $usr++){
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastname);
            $user->setFirstname($faker->firstname);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode(str_replace(' ','',$faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user,"secret")
            );
  
            $manager->persist($user);
        }
        $manager->flush();
    }
}   