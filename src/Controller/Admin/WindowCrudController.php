<?php

namespace App\Controller\Admin;

use App\Entity\Window;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WindowCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Window::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonForm()->hideOnIndex(),
            TextField::new('height'),
            TextField::new('width'),
            TextField::new('name'),
            TextField::new('notes')
        ];
    }
}