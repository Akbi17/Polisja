<?php

namespace App\Controller\Admin;

use App\Entity\Business;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
