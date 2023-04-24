<?php

namespace App\Controller;

use App\Service\Helpers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPageController extends AbstractController
{
    
    public function mentionsLegales(Helpers $app): Response
    {
        return $this->render('static_page/mentions.html.twig', [
            'bodyId' => $app->getBodyId('LEGAL_PAGE'),
        ]);
    }

    public function politiqueCookies(Helpers $app): Response
    {

        return $this->render('static_page/cookies.html.twig', [
            'bodyId' => $app->getBodyId('COOKIE_PAGE'),
        ]);
    }

    public function horaires(Helpers $app): Response
    {
        return $this->render('static_page/horaires.html.twig', [
            'bodyId' => $app->getBodyId('HORAIRES_PAGE'),
        ]);
    }

    
    
    public function presentation(Helpers $app): Response
    {
        return $this->render('static_page/presentation.html.twig', [
            'bodyId' => $app->getBodyId('PRESENTATION_PAGE'),
        ]);
    }

    public function conditions(Helpers $app): Response
    {
        return $this->render('static_page/conditions.html.twig', [
            'bodyId' => $app->getBodyId('CONDITIONS_PAGE'),
        ]);
    }

    public function nous_contacter(Helpers $app): Response
    {
        return $this->render('static_page/nous_contacter.html.twig', [
            'bodyId' => $app->getBodyId('NOUS_CONTACTER_PAGE'),
        ]);
    }
}
