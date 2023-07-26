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
}
