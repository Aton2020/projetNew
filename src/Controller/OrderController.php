<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Produit;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]    
    /**
     * sert à enregistrer les détails de la commande dans la BDD
     *
     * @param  mixed $em
     * @param  mixed $session
     * @return Response
     */
    public function index(EntityManagerInterface $em,SessionInterface $session): Response
    
    
    {

        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }{

        $order = new Order();
        $order->setRef(uniqid('REF-'));
        $order->setUser($this->getUser());
        $order->setCreatedAt(new \DateTime('now'));
        $em->persist($order) ;
        $panier = $session->get('panier', []);
        $panierContenu = [];
        foreach ($panier as $produit => $quantite) {
           
            
            foreach ($panier as $id => $quantite) {
                $panierContenu[] = [
                    'produit' => $em->getRepository(Produit::class)->findOneBy(['id'=>$id]),
                    'quantite'=> $quantite
                ] ;
            }
// dd($panierContenu) ;

        }
        $totalAPayer = 0;
        foreach ($panier as $id => $quantite) {
            $orderItem = new OrderItem();
            $produit = $em->getRepository(Produit::class)->findOneBy(['id'=>$id]) ;
            $orderItem->setRelatedOrder($order);
            $orderItem->setImage($produit->getPhoto());
            $orderItem->setNom($produit->getNom());
            $orderItem->setPrix($produit->getPrix());
            $orderItem->setQuantite($quantite);
            $orderItem->setTotal($produit->getPrix()*$quantite);
            $em->persist($orderItem) ;
            $totalAPayer += ($produit->getPrix()*$quantite);

        }

// dd($order->getRef());
$em->flush() ;          //pour envoyer à la BDD
        }
      return $this->redirectToRoute('app_stripe',[ $session->set('orderTotal', $totalAPayer/100)]); //
    }



//     #[Route('/order/{ref}', name: 'app_paiement_stripe')]
//     public function paiement($ref,EntityManagerInterface $em,SessionInterface $session): Response

// {
//     // dd($ref);

//     return $this->render('order/index.html.twig', [
        
//     ]);
// }
}
