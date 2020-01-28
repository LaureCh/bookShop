<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", methods={"GET","HEAD"}, name="products")
     */
    public function getProducts()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    //   /**
    //  * @Route("/", methods={"GET","HEAD"}, name="accueil")
    //  */
    // public function getAccueil()
    // {
    //     return $this->render('index.html.twig');
    // }

    // /**
    //  * @Route("apropos/{subject}", methods={"GET","HEAD"}, name="about")
    //  */
    // public function getAPropos($subject)
    // {
    //     return $this->render('apropos.html.twig', [
    //         'subject' => $subject
    //     ]);
    // }

    // /**
    //  * @Route("articles", methods={"GET","HEAD"}, name="articles")
    //  */
    // public function getArticles()
    // {
    //     $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

    //     return $this->render('articles.html.twig', array(
    //         "articles" => $articles
    //     ));
    // }
}
