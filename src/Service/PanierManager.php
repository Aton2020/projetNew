<?php


namespace App\Service;


use App\Entity\Membre;

use App\Entity\Panier;

use App\Entity\PanierDetail;
use App\Entity\PanierProduit;
use App\Entity\Produit;
use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

use Symfony\Component\Security\Core\Security;

use Doctrine\Persistence\ManagerRegistry;


class PanierManager

{

  private $params;

  private $doctrine;

  private $security;

  private $db;


  public function __construct(ContainerBagInterface $params, ManagerRegistry $doctrine, Security $security)

  {

    $this->params = $params;

    $this->doctrine = $doctrine;

    $this->db = $doctrine->getManager();

    $this->security = $security;

  }


  public function addToCart(?User $user, ?Produit $product): bool

  {


    if (!$product || !$user) {

      return false;

    }


    $panier = $user->getPanier();


    if ($panier) {

      $panier->setUpdatedAt(new \datetime('now'));

      $panierDetails = $panier->getArticle();


      if (!count($panierDetails)) {

        $panierDetail = new PanierProduit();

        $panierDetail->setPanier($panier);

        $panierDetail->setProduit($product);

        $panierDetail->setQuantity(1);

      } else {

        foreach ($panierDetails as $article) {

          if ($article->getProduit()->getId() === (int)$product->getId()) {

            $article->setQuantity($article->getQuantity() + 1);

            $this->db->persist($panier);

            $this->db->persist($article);

            $this->db->flush();

            return true;

          }

        }

        $panierDetail = new PanierProduit();

        $panierDetail->setPanier($panier);

        $panierDetail->setProduit($product);

        $panierDetail->setQuantity(1);

      }

    } else {

      $panier = new Panier();

      $panierDetail = new PanierProduit();

      $panier->setUser($user);

      $panier->setCreatedAt(new \datetime('now'));

      $panier->setUpdatedAt(new \datetime('now'));

      $panierDetail->setPanier($panier);

      $panierDetail->setProduit($product);

      $panierDetail->setQuantity(1);

    }


    $this->db->persist($panier);

    $this->db->persist($panierDetail);

    $this->db->flush();

    return true;

  }

  public function getCartCount(User $user): int

  {

    $panier = $user->getPanier();

    if ($panier) {

      return $panier->getCountArticle();

    } else {

      return 0;

    }

  }

}