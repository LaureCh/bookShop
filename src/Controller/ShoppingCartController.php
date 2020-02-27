<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ShoppingCartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ShoppingCartController extends AbstractController
{
    protected $cartService;

    public function __construct(ShoppingCartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/shopping", methods={"GET","HEAD"}, name="shopping")
     */
    public function showCart()
    {
        return $this->render('product/shoppingCart.html.twig', [
            "products" => $this->cartService->getCartContent(),
            "total" => $this->cartService->getTotal()
        ]);
    }

/**
     * @Route("/addproduct/{product_id}/{quantity}", name="add_product")
     * @ParamConverter("product", class="App:Product", options={"id"="product_id"})
     */
    public function addProduct(Product $product, int $quantity)
    {
        $this->cartService->addProduct($product, $quantity);

        return $this->redirectToRoute('products');
    }

    /**
     * @Route("removeproduct/{product_id}", name="remove_product")
     * @ParamConverter("product", class="App:Product", options={"id"="product_id"})
     */
    public function removeProduct(Product $product)
    {
        $this->cartService->removeProduct($product);

        return $this->redirectToRoute('shopping');
    }

    public function miniCart()
    {
        $products_number = $this->cartService->countProducts();
        $products = $this->cartService->getCartContent();
        $total = $this->cartService->getTotal();

        return $this->render('mini-cart.html.twig', array(
                "products_number" => $products_number,
                "products" => $products,
                "total" => $total
            )
        );
    }
}
