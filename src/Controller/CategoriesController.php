<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    
    #[Route('/{id}', name: 'list')]
    public function list(Categories $categories): Response
    {
        return $this->render('categories/list.html.twig', compact('category'));
    }
}