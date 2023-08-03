<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Categories;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    
    #[Route('/{id}', name: 'list')]
    public function list(Categories $category): Response
    {
        $produitDeLaliste = $category->getProducts();
        return $this->render('list.html.twig', compact('category','products'));
    }
}