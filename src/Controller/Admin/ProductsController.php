<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/produits', name:'admin_products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(): Response {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/ajout', name:'add')]
    public function add(): Response {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/edition/{id}', name:'editx')]
    public function edit(Products $products): Response {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/supression/{id}', name:'delete')]
    public function delete(Products $products): Response {
        return $this->render('admin/products/index.html.twig');
    }
} 