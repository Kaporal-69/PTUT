<?php

namespace App\DataFixtures;

use App\Entity\CategoriePlat;
use App\Entity\Client;
use App\Entity\Plat;
use App\Entity\Producteur;
use App\Entity\Produit;
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
        $dataRestaurants = [
            0 => [
                'nom' => 'Scratch Restaurant',
                'adresse' => '2 rue des Fontanettes',
            ],
            1 => [
                'nom' => 'Cosy Cook',
                'adresse' => '27 boulevard Paul Bert',
            ],
            2 => [
                'nom' => 'Scratch Restaurant',
                'adresse' => '2 rue des Fontanettes',
            ],
            3 => [
                'nom' => 'Scratch Restaurant',
                'adresse' => '2 rue des Fontanettes',
            ],
            4 => [
                'nom' => 'Scratch Restaurant',
                'adresse' => '2 rue des Fontanettes',
            ]
        ];
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
        for ($i=0; $i < 3; $i++) { 
            $categorie = new CategoriePlat();
            $categorie->setNom("categorie " . $i);
            $manager->persist($categorie);
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
                    $userType->setNomEtablissement('nom');
                    break;
                case 2:
                    $userType = new Producteur();
                    $userType->setNomEtablissement('nom');
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

        $nomPlats = ["Pizza", "Kebab", "Spaghetti Bolognèse", "Salade César", "Sushis", "Boeuf Bourguignon", "Truite Braisée", "Ravioles", "Escargots", "Poulet Bressois"];
        $restaurants = $manager->getRepository(Restaurateur::class)->findAll();
        foreach($restaurants as $restaurant) {
            for ($i=0; $i < 3; $i++) { 
                $plat = new Plat();
                $plat->setNom($nomPlats[random_int(0, count($nomPlats)-1)]);
                $plat->setAllergies('aucune');
                $restaurant->addPlat($plat);
                $manager->persist($plat);
            }
            $manager->persist($restaurant);
        }
        $manager->flush();

        $nomProduits = ["Salade", "Betteraves", "Poulet", "Boeuf", "Carottes", "Fraises", "Pommes de Terre", "Abricots", "Oranges", "Poireaux"];
        $producteurs = $manager->getRepository(Producteur::class)->findAll();
        foreach($producteurs as $producteur) {
            for ($i=0; $i < 3; $i++) { 
                $produit = new Produit();
                $produit->setNom($nomProduits[random_int(0, count($nomPlats)-1)]);
                $producteur->addProduit($produit);
                $manager->persist($produit);
            }
            $manager->persist($producteur);
        }
        $manager->flush();
    }
}
