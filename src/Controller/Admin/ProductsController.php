<?php

namespace App\Controller\Admin;
use App\Entity\Products;
use App\Form\ProductsFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/admin/produits', name:'admin_products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(): Response 
    {     
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/ajout', name:'add')]
    public function add(): Response 
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/product/index.html.twig');

        //creation'nouveau produit'
        $product = new Products();
        //crea form
        $productForm = $this->createForm(ProductsFormType::class,$product);

        //traitement de la requete du formulaire
        //$productForm->handleRequest($request);

        //dd($productForm); //pour le dump

        //verification si le formulaire est soumit et valide
        //if($productForm->isSubmitted() && $productForm->isValid())
       // {
          //  $images = $productForm->get('images')->getData();
          //  $folder = 'products';
            //arrondir le prix 
          //  $prix = $product->getPrice() * 100;
          //  $product->setPrice($prix);

            //dd($prix);

           // $em->persist($product);//stokker les infos et executer dns la bdd
           // $em->flush();//et executer dns la bdd

            
        //    return $this->redirectToRoute('admin_products_index');//redirige
        //}

        //    return $this->render('admin/products/add.html.twig',[
         //   'productForm' => $productForm->createView()
        //]);
            //ou 
            return $this->renderForm('admin/products/add.html.twig', compact('productForm'));
   // }
    

        #[Route('/edition/{id}', name:'edit')]
        public function edit(Products $products): Response 
        {

        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $products);//verif si utilisateur peut editer avc le voter

         // On divise le prix par 100
        // $prix = $product->getPrice() / 100;
        // $product->setPrice($prix);

        // On crée le formulaire
        //$productForm = $this->createForm(ProductsFormType::class, $product);

        // On traite la requête du formulaire
        //$productForm->handleRequest($request);

        //On vérifie si le formulaire est soumis ET valide
        //if($productForm->isSubmitted() && $productForm->isValid()){
            // On récupère les images
           // $images = $productForm->get('images')->getData();

                // On arrondit le prix 
           // $prix = $product->getPrice() * 100;
           // $product->setPrice($prix);

            // On stocke
           // $em->persist($product);
           // $em->flush();

           // $this->addFlash('success', 'Produit modifié avec succès');

            // On redirige
            return $this->render('admin/product/index.html.twig');
        //}

        //return $this->render('admin/products/index.html.twig',[
            //'productForm' => $productForm->createView(),
            //'product' => $product
           // ]};

        //return $this->renderForm('admin/products/edit.html.twig', compact('productForm'));
        // ['productForm' => $productForm]
        }


    #[Route('/supression/{id}', name:'delete')]
    public function delete(Products $products): Response {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $products);//verif si utilisateur peut supprim avc le voter
        return $this->render('admin/products/index.html.twig');
    }

    
} 