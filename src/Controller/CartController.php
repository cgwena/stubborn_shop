<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getTotal(),
        ]);
    }

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function add(Request $request, CartService $cartService, int $id): Response
    {
        $size = $request->request->get('size');
        $cartService->addToCart($id, $size);

        return $this->redirectToRoute('app_cart', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/removeOne/{id<\d+>}', name: 'cart_remove_one')]
    public function removeOne(Request $request, CartService $cartService, int $id): Response
    {
        $size = $request->request->get('size');
        $cartService->removeOne($id, $size);

        return $this->redirectToRoute('app_cart', [
            'controller_name' => 'CartController',
        ]);
    }


    #[Route('/cart/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeFromCart(Request $request, CartService $cartService, int $id): Response
    {
        $size = $request->request->get('size');

        $cartService->removeFromCart($id, $size);

        return $this->redirectToRoute('app_cart', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/removeAll', name: 'cart_removeAll')]
    public function removeAll(CartService $cartService): Response
    {
        $cartService->removeAll();

        return $this->redirectToRoute('app_product', [
            'controller_name' => 'CartController',
        ]);
    }
}
