<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Service\Helpers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    public function index(Helpers $app, CategorieRepository $categorieRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'bodyId' => $app->getBodyId('HOME_PAGE'),
            'categories' => $categorieRepository->findAll(),
            
        ]);
    }
}
