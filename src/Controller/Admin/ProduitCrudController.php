<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('poids'),
            MoneyField::new('prix')->setCurrency('EUR'),
            TextareaField::new('description'),
            NumberField::new('stock'),
            ImageField::new('photo')
                ->setBasePath('img_produits')
                ->setUploadDir('public/img_produits'),
            AssociationField::new('Categorie')
        ];
    }
}
