<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(ManagerRegistry $manager): Response
    {
        $homepageProducts = $manager->getRepository(Product::class)->findBy(array('homepage'=>true));
        return $this->render('home/index.html.twig', [
            'homepageProducts' => $homepageProducts,
        ]);
    }
}
