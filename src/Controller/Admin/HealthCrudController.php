<?php

namespace App\Controller\Admin;

use App\Entity\Health;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HealthCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Health::class;
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
