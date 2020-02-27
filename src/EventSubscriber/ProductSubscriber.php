<?php
namespace App\EventSubscriber;
 
use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;


class ProductSubscriber implements EventSubscriber
{
    const COUNTRY = "FRA";

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }
 
    public function prePersist(LifecycleEventArgs $args)
    {
        $product = $args->getObject();
        $em = $args->getObjectManager();

        if ($product instanceof Product) {
            //Check if alpha3 exists
            $alpha3 = $product->getCountry();
            $countries = Yaml::parseFile('/../../config/countries.yaml');
            dump($countries); die;
            
            if (!in_array($alpha3, $countries))
            {
                throw new InvalidArgumentException("Country code doesn't exist");
            }
            else
            { 
                //Check if originalTitle exists
                if (($alpha3 != self::COUNTRY) && (null != $product->getOriginalTitle()) ) {
                    throw new InvalidArgumentException("Original Title is required.");
                }

                }
            }

        }

}