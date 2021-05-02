<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
