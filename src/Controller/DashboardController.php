<?php

namespace App\Controller;

use App\Entity\CategoriePlat;
use App\Entity\Plat;
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
                $resto = $user->getRetaurateur();
                $plats = [];
                foreach($resto->getPlats() as $plat) {
                    $plats[] = ['nom' => $plat->getNom()];
                }
                $data['resto']['plats'] = $plats;
                $data['resto']['adresse'] = $resto->getAdresse() . ', ' . $resto->getCodePostal() . ', ' . $resto->getVille();
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
                $plat = new Plat();
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
}
