<?php

namespace App\Controller\Admin;

use App\Repository\WindowOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarAdminController extends AbstractController
{
    public function __construct(private WindowOrderRepository $orderRepository)
    {

    }

    /**
     * @Route("/admin/calendar", name="admin_calendar")
     */
    public function index(): Response
    {
        return $this->render('admin/calendar.html.twig');
    }

    #[Route('/admin/calendar/events', name: 'admin_calendar_events')]
    public function getEvents():JsonResponse
    {
        $bookings = $this->orderRepository->findAll();
        $bookedDates = array_map(function ($booking) {
            return [
                'id' => $booking->getId(),
                'title' => 'Booked',
                'start' => $booking->getInstallationDate()->format('Y-m-d'),
                'color' => $booking->getStatus()->getColor(),
            ];
        }, $bookings);

        return new JsonResponse($bookedDates);
    }


    #[Route('/admin/calendar/booking/{id}', name: 'admin_calendar_booking_detail', methods: ['GET'])]

    public function getBookingDetail($id): JsonResponse
    {
        $booking = $this->orderRepository->find($id);

        if (!$booking) {
            return new JsonResponse(['error' => 'The booking does not exist'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'count' => $booking->getNumberOfWindows(),
            'address' => 'Customer address here',
            'details' => $booking->getWindowsMeasurement()
        ]);
    }
}
