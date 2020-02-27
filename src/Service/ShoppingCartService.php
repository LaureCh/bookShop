<?php


namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShoppingCartService
{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        if ($this->session->get('cart') === null) {
            $this->session->set('cart', array());
        }
    }

    public function addProduct(Product $product, $quantity = 1)
    {
    
        $cart = $this->session->get('cart');

        $book = array(
            'product' => $product,
            'quantity' => $quantity,
            'price' => $product->getPrice()
        );

        if(array_key_exists($product->getId(), $cart)){
            $book['quantity'] +=  $cart[$product->getId()]['quantity'];
        }

        $cart[$product->getId()] = $book;

        $this->session->set('cart', $cart);
    }

    public function getCartContent(){
        return $this->session->get('cart');
    }

    public function getTotal(){
        $cart = $this->session->get('cart');
        $total = 0;
        foreach ($cart as $product) {
            $total += $product['product']->getPrice() * $product['quantity'];
        };
        return $total;
    }

    public function emptyCart(){
        $this->session->set('product', array());
    }

    public function isEmpty(){
        if(empty($this->session->get('cart'))){
            return true;
        }

        return false;
    }

    public function removeProduct(Product $product){
        $cart = $this->session->get('cart');

        if($this->getProduct($product->getId())){

            unset($cart[$product->getId()]);
            $this->session->set('cart', $cart);

        }
    }

    public function getProduct($id){
        $cart = $this->session->get('cart');

        if(array_key_exists($id, $cart)){
            return $cart[$id]['product'];
        }else{
            return null;
        }
    }

    public function countProducts()
    {
        $cart = $this->session->get('cart');
        $count = 0;
        foreach ($cart as $meal) {
            $count += $meal['quantity'];
        };
        return $count;
    }
}