<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Producteur;
use App\Entity\Restaurateur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $users = [];
        for ($i=0; $i < 20; $i++) { 
            $user = new User();
            $user->setEmail($faker->email);
            if($i == 0) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }
            $user->setPassword(
                $this->encoder->encodePassword(
                    $user,
                    'pswd1234'
                )
            );
    
            $manager->persist($user);
            $users[] = $user;
            $manager->flush();
        }

        $rotation = 0;
        foreach($users as $user) {
            switch($rotation) {
                case 0:
                    $userType = new Client();
                    break;
                case 1:
                    $userType = new Restaurateur();
                    break;
                case 2:
                    $userType = new Producteur();
                    $rotation = -1;
                    break;
            }
            $userType->setAdresse($faker->streetAddress);
            $userType->setUser($user);
            $userType->setCodePostal('01000');
            $userType->setVille('Bourg en Bresse');
            $manager->persist($user);
            $manager->persist($userType);
            $manager->flush();
            $rotation ++;
        }
    }
}
