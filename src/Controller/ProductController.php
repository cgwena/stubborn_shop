<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'product_by_id')]
    public function productById(int $id,ManagerRegistry $manager): Response
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);
        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }
}