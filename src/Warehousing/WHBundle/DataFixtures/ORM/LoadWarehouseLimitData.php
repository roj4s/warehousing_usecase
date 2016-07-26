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



        for ($i=0; $i < count($warehouses) -1 ; $i++) { 
            for ($j=1; $j< count($warehouses); $j++) { 
                
                $new_wl = new WarehouseLimits();
                $limit = random_int(1, 15) / random_int(1, 10);
                $new_wl->setWarehouseOrigin($warehouses[$i]);
                $new_wl->setWarehouseTarget($warehouses[$j]);
                $new_wl->setWhLimit($limit);
                $manager->persist($new_wl);

                $rev = new WarehouseLimits();
                $part = rand(0, 30) / 30;
                $limit = 30 * $part;
                $rev->setWarehouseOrigin($warehouses[$j]);
                $rev->setWarehouseTarget($warehouses[$i]);
                $rev->setWhLimit($limit);
                $manager->persist($rev);

                }            
            }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}