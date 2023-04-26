<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    // public function configureFields(string $pageName): iterable
    // {
    //     yield AssociationField::new('Categorie', 'Catégorie')->setFormTypeOption('query_builder', 
    //         fn (CategorieRepository $repo) => $repo->createQueryBuilder('s')
    //     );
    // }
    
}
