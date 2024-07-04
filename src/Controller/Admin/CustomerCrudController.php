<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('fullName')->setRequired(true),
            EmailField::new('email')->setRequired(false),
            TextField::new('mobile')->setRequired(false),
            TextField::new('address')->setRequired(false),
            NumberField::new('yearOfBuild')->setRequired(false),
            MoneyField::new('deposit')->setCurrency('CAD')->setRequired(false),
            MoneyField::new('balance')->setCurrency('CAD')->setRequired(false),
        ];
    }
}
