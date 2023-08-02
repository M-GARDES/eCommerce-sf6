<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/produits', name: 'products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'app_products')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig',);
    }
    
    #[Route('/{id}', name: 'details')]
    public function details(Products $product): Response
    {
    // dump & die ($product)
    // dd($product);
    return $this->render('products/details.html.twig', compact('product'));
    }
}
    

