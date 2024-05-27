<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Closure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher,
        public RoleRepository              $roleRepository,
        public UserRepository              $userRepository
    )
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

//    public function configureActions(Actions $actions): Actions
//    {
//        return $actions
//            ->add(Crud::PAGE_EDIT, Action::INDEX)
//            ->add(Crud::PAGE_INDEX, Action::DETAIL)
//            ->add(Crud::PAGE_EDIT, Action::DETAIL);
//    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideonForm()->hideOnIndex(),
            TextField::new('email'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('role')->hideOnForm()


        ];
        $roles = ChoiceField::new('roles', 'Roles')
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->hideOnIndex()
            ->allowMultipleChoices()
            ->autocomplete()
            ->setChoices(
                $this->getUniqueRoles()
            );
        $fields[] = $roles;

        $password = TextField::new('password')
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms();
        $fields[] = $password;

        return $fields;
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    /**
     * @return Closure
     */
    private function hashPassword(): Closure
    {
        return function ($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }

            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $user = $this->userRepository->findOneBy(['email' => $form->get('email')->getData()]);
            if (!$user) {
                $user = new User();
            }

            $hash = $this->userPasswordHasher->hashPassword($user, $password);
            $form->getData()->setPassword($hash);
        };
    }

    private function getUniqueRoles(): array
    {
        return $this->roleRepository->getUniqueRoles();
    }
}