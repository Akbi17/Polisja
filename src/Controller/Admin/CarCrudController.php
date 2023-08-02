<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Entity\Auto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auto::class;
    }
}
