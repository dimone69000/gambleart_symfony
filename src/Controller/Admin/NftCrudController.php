<?php

namespace App\Controller\Admin;

use App\Entity\Nft;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class NftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nft::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            UrlField::new('imageUrl')->onlyOnForms(),
            MoneyField::new('price')->setCurrency('EUR'),
            DateField::new('dateDrop'),
            AssociationField::new('category'),
            AssociationField::new('user')

        ];
    }
    
}
