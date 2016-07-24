<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <30 ; $i++) { 
        
        	$new_p = new Product();
            $code = "Pro_".base64_encode(random_bytes(10));
            $comercial_name = "ComName_".base64_encode(random_bytes(5));
            $unitary_price = random_int(1, 15) / random_int(1, 10);
            $new_p->setCode($code);
            $new_p->setCommercialName($comercial_name);
            $new_p->setUnitaryPrice($unitary_price);

            $manager->persist($new_p);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}