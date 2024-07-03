<?php

namespace App\Controller\Admin;

use App\Entity\WindowOrder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WindowOrderCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return WindowOrder::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonForm()->hideOnIndex(),
            TextField::new('name'),
            TextField::new('note'),
            DateTimeField::new('installationDate'),
            MoneyField::new('price')->setCurrency('CAD'),
            AssociationField::new('status')->autocomplete(),
           CollectionField::new('windows')->useEntryCrudForm(WindowCrudController::class)->hideOnIndex(),
           CollectionField::new('windows')->onlyOnDetail()->setEntryType(WindowCrudController::class)
               ->setTemplatePath('admin/windows/index.html.twig'),
            IntegerField::new('numberOfWindows', 'Windows count')->onlyOnIndex(),
            ArrayField::new('getNameOfWindows', 'Name & size')->onlyOnIndex(),
            ArrayField::new('windows','windows')->onlyOnDetail(),


//            AssociationField::new('status')
//            ->autocomplete(function (array $datas, WindowOrder $order) {
//                    foreach ($datas as $data) {
//                        $window = (new Window())
//                            ->setHeight($data)
//                            ->setWidth($data);
//                        $this->entityManager->persist($window);
//                        $order->addWindow($window);
//                    }
//                }),
        ];
    }
}