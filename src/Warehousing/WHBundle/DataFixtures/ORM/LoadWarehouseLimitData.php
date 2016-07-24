<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\WarehouseLimits;

class LoadWarehouseLimitData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $warehouses = $manager->getRepository("WHBundle:Warehouse")->findAll();

        for ($i=0; $i <30 ; $i++) { 
        
        	$new_wl = new WarehouseLimits();
            $limit = random_int(1, 15) / random_int(1, 10);
            $new_wl->setWhLimit($limit);
            shuffle($warehouses);
            $new_wl->setWarehouseOrigin($warehouses[0]);
            $new_wl->setWarehouseTarget($warehouses[3]);


            $manager->persist($new_wl);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}