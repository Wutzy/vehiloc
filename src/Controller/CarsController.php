<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CarRepository;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Car;

class CarsController extends AbstractController
{    
    public function __construct(
        private CarRepository $carRepository,
        private EntityManagerInterface $entityManager,
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
    * Add new car
    */
    #[Route('/car/add', name: 'app_add_car')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_add_car');
        }

        return $this->render('admin/car/new.html.twig', [
            'form' => $form,
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

        $this->entityManager->remove($car);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
