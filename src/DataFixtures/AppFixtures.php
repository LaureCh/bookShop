<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Product 1
         $product1 = new Product();
         $product1->setTitle('La Horde du contrevent'); 
         $product1->setCountry('FR'); 
         $product1->setDescription('Best french sci-fi book');
         $product1->setOriginalTitle('Horde du contrevent');
         $product1->setPrice(20);
         $product1->setEditionYear(new DateTime('now'));
         $product1->setRank(10);
         $product1->setType('Sci-fi');
         $product1->setProductType('Paper');
         $manager->persist($product1);


        //Product 2
         $product2 = new Product();
         $product2->setTitle('Seigneur des anneaux'); 
         $product2->setCountry('NZ'); 
         $product2->setDescription('An unlimited book');
         $product2->setOriginalTitle('Lord of the Ring');
         $product2->setPrice(40);
         $product2->setEditionYear(new DateTime('now'));
         $product2->setRank(5);
         $product2->setType('Fantasy');
         $product2->setProductType('CD');
         $manager->persist($product2);

        $manager->flush();
    }
}
