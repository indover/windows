<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Entity\User;
use App\Entity\WindowOrder;
use App\Entity\OrderStatus;
use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
//         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
//         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('API');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Calendar', 'fas fa-calendar');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-users-gear', User::class);
        yield MenuItem::linkToCrud('Roles', 'fa-solid fa-address-book', Role::class);
        yield MenuItem::linkToCrud('Orders Status', 'fa-solid fa-check-circle', OrderStatus::class);
        yield MenuItem::linkToCrud('Orders', 'fa-solid fa-regular fa-cart-shopping', WindowOrder::class);
        yield MenuItem::linkToCrud('Customers', 'fa-solid fa-users', Customer::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addHtmlContentToHead('
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
            ');
    }
}
