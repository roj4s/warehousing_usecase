<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Warehouse;

class LoadWarehouseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	for ($i=0; $i <5 ; $i++) { 

    		$new_warehouse = new Warehouse();
        	$random_label = "WH_" . base64_encode(random_bytes(6));
        	$new_warehouse->setLabel($random_label);
        

        	$manager->persist($new_warehouse);
    	}
        
        $manager->flush();
    }

    public function getOrder()
    {

        return 1;
    }
}
