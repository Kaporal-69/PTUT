<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Producteur;
use App\Entity\Restaurateur;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserLoginAutenticatorAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/api/register",  options = { "expose" = true }, name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserLoginAutenticatorAuthenticator $authenticator)
    {
        $user = new User();   
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
     
        try {
            $user->setEmail($request->request->get('email'));
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $request->request->get('plainPassword')
                )
            );
            switch($request->request->get('userType')) {
                case 1:
                    $userType = new Client();
                    $userType->setAdresse($request->request->get('adress'));
                    $userType->setCodePostal($request->request->get('zipCode'));
                    $userType->setVille($request->request->get('city'));
                    $user->setClient($userType);
                    break;
                case 2:
                    $userType = new Producteur();
                    $userType->setAdresse($request->request->get('adress'));
                    $userType->setCodePostal($request->request->get('zipCode'));
                    $userType->setVille($request->request->get('city'));
                    $user->setProducteur($userType);
                    break;
                case 3:
                    $userType = new Restaurateur();
                    $userType->setAdresse($request->request->get('adress'));
                    $userType->setCodePostal($request->request->get('zipCode'));
                    $userType->setVille($request->request->get('city'));
                    $user->setRetaurateur($userType);
                    break;
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userType);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->json('success');
        } catch (\Exception $e) {
            return $this->json("une erreur s'est produite: " . $e->getMessage(),500);
        }
    }
}
