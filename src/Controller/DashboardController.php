<?php

namespace App\Controller;

use App\Entity\CategoriePlat;
use App\Entity\CategorieProduit;
use App\Entity\Plat;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
   /**
     * @Route("/api/dashboard/data",  options = { "expose" = true }, name="app_dashboard_data")
     */
    public function getDashboardData() {
        $user = $this->getUser();
        $data = [];
        if(!$user || (!$user->getRetaurateur() && !$user->getProducteur() ) ) {
            return $this->json("Vous n'avez pas accès à cette page.",401);
        } else {
            if($user->getRetaurateur()) {
                $data['typeEtablissement'] = "Restaurant";
                $resto = $user->getRetaurateur();
                $plats = [];
                foreach($resto->getPlats() as $plat) {
                    $plats[] = ['nom' => $plat->getNom(), 'id' => $plat->getId()];
                }
                $data['etablissement']['items'] = $plats;
                $data['etablissement']['adresse'] = $resto->getAdresse() . ', ' . $resto->getCodePostal() . ', ' . $resto->getVille();
                return $this->json($data);
            } else  if($user->getProducteur()){
                $data['typeEtablissement'] = "Producteur";
                $producteur = $user->getProducteur();
                $produits = [];
                foreach($producteur->getProduits() as $produit) {
                    $produits[] = ['nom' => $produit->getNom(), 'id' => $produit->getId()];
                }
                $data['etablissement']['items'] = $produits;
                $data['etablissement']['adresse'] = $producteur->getAdresse() . ', ' . $producteur->getCodePostal() . ', ' . $producteur->getVille();
                return $this->json($data);

            }
        }
    }

    /**
     * @Route("/api/plat/add",  options = { "expose" = true }, name="app_add_plat", methods= { "POST" })
     */
    public function addPlatToResto(Request $request) {
        $user = $this->getUser();
        $data = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();
        $categoryRepo = $entityManager->getRepository(CategoriePlat::class);
        if(!$user || !$user->getRetaurateur()) {
            return $this->json("Vous n'avez pas accès à cette page.",401);
        } else {
            if($user->getRetaurateur()) {
                $resto = $user->getRetaurateur();
                if($data->id) {
                    $plat = $entityManager->getRepository(Plat::class)->findOneById($data->id);
                } else {
                    $plat = new Plat();
                }
                $categorie = $categoryRepo->findOneById($data->category);
                $plat->setCategorie($categorie);
                $plat->setRestaurateur($resto);
                $plat->setNom($data->name);
                $plat->setDescription($data->description);
                $plat->setPrix($data->price);
                $plat->setAllergies($data->allergies);
                $entityManager->persist($categorie);
                $entityManager->persist($plat);
                $entityManager->persist($resto);
                $entityManager->flush();
                return $this->json($plat->getNom());
            }
        }
    }

    /**
     * @Route("/api/produit/add",  options = { "expose" = true }, name="app_add_produit", methods= { "POST" })
     */
    public function addProduitToProducteur(Request $request) {
        $user = $this->getUser();
        $data = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();
        $categoryRepo = $entityManager->getRepository(CategorieProduit::class);
        if(!$user || !$user->getProducteur()) {
            return $this->json("Vous n'avez pas accès à cette page.",401);
        } else {
            if($user->getProducteur()) {
                $prod = $user->getProducteur();
                if($data->id) {
                    $produit = $entityManager->getRepository(Produit::class)->findOneById($data->id);
                } else {
                    $produit = new Produit();
                }
                $categorie = $categoryRepo->findOneById($data->category);
                $produit->setCategorieProduit($categorie);
                $produit->setProducteur($prod);
                $produit->setNom($data->name);
                $produit->setPrix($data->price);
                $entityManager->persist($categorie);
                $entityManager->persist($produit);
                $entityManager->persist($prod);
                $entityManager->flush();
                return $this->json($produit->getNom());
            }
        }
    }
}
