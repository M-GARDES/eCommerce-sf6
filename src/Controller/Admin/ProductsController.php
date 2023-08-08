<?php

namespace App\Controller\Admin;
use App\Entity\Products;
use App\Form\ProductsFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/produits', name:'admin_products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(): Response 
    {   
        return $this->render('admin/products/index.html.twig');
    }



    #[Route('/ajout', name:'add')]
    public function add(Request $request, EntityManagerInterface $em): Response 
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        //creer nouveau produit
        $product = new Products();

        //creer le formulaire
        $productForm = $this->createForm(ProductsFormType::class, $product);
         
        //traitement requete formulaire
        $productForm->handleRequest($request);

        //dd($productForm);

        //verifi si form soumis et valide
        if($productForm->isSubmitted() && $productForm->isValid()){
            //generer le slug
            //$slug = $slugger->slug($product->getName());
            //$product->setSlug($slug);

            //arrondir le prix
            $prix = $product->getPrice() * 100;
            $product->setPrice($prix);

            $em->persist($product);//stokker info
            $em->flush();//executer et stokker dans la bdd

            //possibilite de messageFlash
            $this->addFlash('success', 'Produit ajouté avec succés');

            //Redirection
            return $this->redirectToRoute('admin_products_index');
        }

            return $this->render('admin/products/add.html.twig',[
                'productForm' => $productForm->createView()
        ]);      
           //ou
        //return $this->renderForm('admin/products/add.html.twig', 
        //compact('productForm'))  
    }
    

    #[Route('/edition/{id}', name:'edit')]
    public function edit(Products $product, Request $request, EntityManagerInterface $em): Response 
    {

        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);//verif si utilisateur peut editer avc le voter

        // On crée le formulaire
        $productForm = $this->createForm(ProductsFormType::class, $product);
        
        $productForm->handleRequest($request);
      
        if($productForm->isSubmitted() && $productForm->isValid()){

            //arrondir le prix
            $prix = $product->getPrice() * 100;
            $product->setPrice($prix);

            $em->persist($product);//stokker info
            $em->flush();//executer et stokker dans la bdd

            //possibilite de messageFlash
            $this->addFlash('success', 'Produit ajouté avec succés');

            //Redirection
            return $this->redirectToRoute('admin_products_index');
        }
        return $this->render('admin/products/edit.html.twig',[
            'productForm' => $productForm->createView()
    ]);      
        //ou
        //return $this->renderForm('admin/products/edit.html.twig', 
        //compact('productForm')); 
    }


    #[Route('/supression/{id}', name:'delete')]
    public function delete(Products $products): Response {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $products);//verif si utilisateur peut supprim avc le voter
        return $this->render('admin/products/index.html.twig');
    } 
} 