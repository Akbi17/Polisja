<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Business;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }
}
