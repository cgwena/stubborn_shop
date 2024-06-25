<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin', methods: ['POST','GET'])]
    #[OA\Post(
        path: '/admin',
        tags: ['Admin'],
        summary: 'Ajouter un produit',
        description: 'Affiche la page d\'administration permettant d\'ajouter et de gérer les produits.',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Page d\'administration affichée'
            )
        ]
    )]
    public function add(Request $request, ManagerRegistry $manager): Response
    {
        
        $newproduct = new Product;
        $products = $manager->getRepository(Product::class)->findAll();

        //Création d'un formulaire pour ajouter un produit
        $formAdd = $this->createForm(ProductType::class, $newproduct);
        $formAdd->handleRequest($request);
        if ($formAdd->isSubmitted() && $formAdd->isValid()) {
            $om = $manager->getManager();
            $om->persist($newproduct);
            $om->flush();
            return $this->redirectToRoute('admin');
        }

        $productForms = [];
        foreach ($products as $product) {
            $form = $this->createForm(ProductType::class, $product, [
                'action' => $this->generateUrl('update_product', ['id' => $product->getId()]),
                'method' => 'POST'
            ]);
            $productForms[$product->getId()] = $form->createView();
        }

        return $this->render('admin/add_product.html.twig', [
            'formAdd' => $formAdd->createView(),
            'productForms' => $productForms,
            'products' => $products,
        ]);

    }

    #[Route('/admin/updateProduct/{id}', name: 'update_product', methods: ['POST'])]
    #[OA\Post(
        path: '/admin/updateProduct/{id}',
        tags: ['Admin'],
        summary: 'Mettre à jour un produit',
        description: 'Met à jour un produit existant selon son ID.',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Identifiant unique du produit',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Produit mis à jour'
            ),
            new OA\Response(
                response: 404,
                description: 'Produit non trouvé'
            )
        ]
    )]
    public function update(int $id, ManagerRegistry $manager, Request $request): Response
    {
        $product = $manager->getRepository(Product::class)->find($id);
    if (!$product) {
        throw $this->createNotFoundException('No product found for id ' . $id);
    }

    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $om = $manager->getManager();
        $om->persist($product);
        $om->flush();
        return $this->redirectToRoute('admin');
    }

    return $this->render('admin/edit_product.html.twig', [
        'form' => $form->createView(),
        'product' => $product
    ]);
    }

    #[Route('/admin/deleteProduct/{id}', name: 'delete_product', methods: ['POST','GET'])]
    #[OA\Post(
        path: '/admin/deleteProduct/{id}',
        tags: ['Admin'],
        summary: 'Supprimer un produit',
        description: 'Supprime un produit existant selon son ID.',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Identifiant unique du produit',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Produit supprimé'
            ),
            new OA\Response(
                response: 404,
                description: 'Produit non trouvé'
            )
        ]
    )]

    public function delete(int $id, ManagerRegistry $manager): Response
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);
        $om = $manager->getManager();
        $om->remove($product);
        $om->flush();
        return $this->redirectToRoute('admin');
    }
}
