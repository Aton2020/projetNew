<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Service\Helpers;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private string $bodyId; 
    private $app;
    private $db; 
    private $userInfo; 
    private $session;

    public function __construct(ManagerRegistry $doctrine, Helpers $app, RequestStack $requestStack)
    {
        $this->app = $app;
        $this->bodyId = $app->getBodyId('HOME_PAGE');
        $this->db = $doctrine->getManager();
        $this->userInfo = $app->getUser();
        $this->session = $requestStack->getSession();

    }

    public function index(int $catId): Response
    {
        $category = $this->db->getRepository(Categorie::class)->find($catId);

        $tableauProduits = $this->db->getRepository(Produit::class)->findBy(['Categorie' => $category]);
        dump($tableauProduits);
        exit;

        return $this->render('category/index.html.twig', [
            'tableauProduits' => $tableauProduits,
        ]);
    }

    
    public function biscuits(): Response
    {
        $categories = $this->db->getRepository(Categorie::class)->findAll();
        

        $idBiscuitSucre = null;
        $idBiscuitSale = null;

        foreach($categories as $cat) {
            if($cat->getName() === 'Biscuit sucré') {
                $idBiscuitSucre = $cat->getId();
            }
        }
        
        foreach($categories as $cat) {
            if($cat->getName() === 'Biscuit salé') {
                $idBiscuitSale = $cat->getId();
            }
        }

        return $this->render('static_page/biscuits.html.twig', [
            'bodyId' => $this->app->getBodyId('BISCUITS_PAGE'),
            'idBiscuitSucre' => $idBiscuitSucre,
            'idBiscuitSale' =>$idBiscuitSale,
        ]);
        
    }

    #[Route('/category/{id}', name: 'category_show')]
    public function show(Categorie $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }

    public function chocolats(): Response
    {
        $categories = $this->db->getRepository(Categorie::class)->findAll();
        
        foreach($categories as $cat) {
            if($cat->getName() === 'Chocolat au lait') {
                $idChocolatAuLait = $cat->getId();
            }
        }
        
        foreach($categories as $cat) {
            if($cat->getName() === 'Chocolat noir') {
                $idChocolatNoir = $cat->getId();
            }
        }

        foreach($categories as $cat) {
            if($cat->getName() === 'Chocolat blanc') {
                $idChocolatBlanc = $cat->getId();
            }
        }

        return $this->render('static_page/chocolats.html.twig', [
            'bodyId' => $this->app->getBodyId('CHOCOLATS_PAGE'),
            'idChocolatAuLait' => $idChocolatAuLait,
            'idChocolatNoir' =>$idChocolatNoir,
            'idChocolatBlanc' =>$idChocolatBlanc,
        ]);
    }

        public function friandises(): Response
    {
        $categories = $this->db->getRepository(Categorie::class)->findAll();
        
        foreach($categories as $cat) {
            if($cat->getName() === 'Friandises') {
                $idFriandises = $cat->getId();
            }
        }
        
        return $this->render('static_page/friandises.html.twig', [
            'bodyId' => $this->app->getBodyId('FRIANDISES_PAGE'),
            'idFriandises' => $idFriandises,
        ]);

    }

    }