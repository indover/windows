<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Closure;
use Doctrine\DBAL\Driver\SQLite3\Exception;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

class RoleCrudController extends AbstractCrudController
{
    public function __construct(
        public RoleRepository              $roleRepository,
    )
    {
    }
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonForm()->hideOnIndex(),
            ArrayField::new('role')->hideonForm(),
            TextField::new('name')
        ];
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addRoleEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addRoleEventListener($formBuilder);
    }

    private function addRoleEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->setRole());
    }

    private function setRole(): Closure
    {
        return function ($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }

            $name = $form->get('name')->getData();
            if ($name === null) {
                return;
            }

            $role = $this->roleRepository->findOneBy(['name' => $name]);
            if (!$role) {
                $form->getData()->setRole(['ROLE_'.strtoupper($name)]);
            } else {
                throw new Exception('Role exist.');
            }
        };
    }
}