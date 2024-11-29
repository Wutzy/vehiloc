<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;

class CarsController extends AbstractController
{    
    public function __construct(
        private CarRepository $carRepository,
    )
    {

    }

    /*
    * Home page
    */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $cars = $this->carRepository->findAll();

        return $this->render('cars/index.html.twig', [
            'cars' => $cars
        ]);
    }

    /*
    * Detail Page
    */
    #[Route('/car/{id}', name: 'app_car')]
    public function detail(int $id): Response
    {
        $car = $this->carRepository->find($id);

        return $this->render('cars/detail.html.twig', [
            'car' => $car
        ]);
    }

    /*
    * Delete function
    */
    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(int $id, EntityManagerInterface $manager): Response
    {
        $car = $this->carRepository->find($id);

        $manager->remove($car);
        $manager->flush();

        return $this->redirectToRoute('app_home');
    }

}
