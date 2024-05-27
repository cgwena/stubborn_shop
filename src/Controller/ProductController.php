<?php

namespace App\Controller;

use App\Entity\PriceChoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(Request $request, ManagerRegistry $manager): Response
    {

        $products = $manager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }



    #[Route('/product/{id}', name: 'product_by_id')]
    public function productById(int $id, ManagerRegistry $manager): Response
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);
        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route("/filter-products", name: "filter_products", methods: "GET")]

    public function filterProducts(Request $request, ProductRepository $productRepository)
    {
        $priceRange = (int) $request->query->get('priceRange');

        switch ($priceRange) {
            case 1:
                $products = $productRepository->findByPriceRange(10, 30);
                break;
            case 2:
                $products = $productRepository->findByPriceRange(30, 35);
                break;
            case 3:
                $products = $productRepository->findByPriceRange(35, 50);
                break;
            default:
                $products = $productRepository->findAll();
        }

        $response = [];
        foreach ($products as $product) {
            $response[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'imageName' => $product->getImageName()
            ];
        }

        return new JsonResponse($response);
    }
}
