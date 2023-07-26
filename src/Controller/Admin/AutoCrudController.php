<?php

namespace App\Controller\Admin;

use App\Entity\Auto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AutoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auto::class;
    }
}
