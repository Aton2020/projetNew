<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session , EntityManagerInterface $em): Response
    {
        $panier = $session->get('panier', []);
        $panierContenu = [];
        foreach ($panier as $id => $quantite) {
            $panierContenu[] = [
                'produit' => $em->getRepository(Produit::class)->findOneBy(['id'=>$id]),
                'quantite'=> $quantite
            ] ;
        }

        return $this->render('panier/index.html.twig', [
            'produitsPanier' =>  $panierContenu,
        ]);
    }


    #[Route('/panier/ajout/{id}', name: 'app_panier_ajout')]
    public function ajouterAuPanier($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);
        

        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/suppression/{id}', name: 'app_panier_suppression')]
    public function supprimerAuPanier($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        } 
        $session->set('panier', $panier);
        

        return $this->redirectToRoute('app_panier');
    }
}
