<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]

    private $user; 
    
    public function __construct()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->user = $this->getUSer();
    }

    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**

     * Méhode déclenchée par l'url: '/admin/members'

     * Route servie: app_admin

     * Appelle la vue: 'admin/member-management.html.twig'

     *

     * Fonction:

     * Affiche la page gestion des membres

     * du back office de l'espace administrateur

     *

     * @return Response

     */

     public function memberManagement(): Response

     {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
         return $this->render('admin/member-management.html.twig', []);
 
     }
 
 }
 
 

