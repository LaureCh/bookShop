<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", methods={"GET","HEAD"}, name="products")
     */
    public function getProducts()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllSortedAsc();
        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/{product_id}", methods={"GET","HEAD"}, name="product_show")
     * @ParamConverter("product", class="App:Product", options={"id"="product_id"})
     */
    public function getProduct($product)
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
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
