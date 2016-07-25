<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Admin;

class LoadAdminData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	$warehouses = $manager->getRepository("WHBundle:Warehouse")->findAll();
        $whi = 0;

    	for ($i=0; $i <2 ; $i++) { 
    		
    		$new_admin = new Admin();
            $new_admin->setName("ADM_".base64_encode(random_bytes(7)));


        	$q_of_wh = random_int(1, 2);
            $this_admin_whs = array();
        	
            while ($q_of_wh >= 1) {
                
                $w = $warehouses[$whi];
                $whi ++;
                array_push($this_admin_whs, $w);
                $q_of_wh --;

            }

            $new_admin->setWarehouses($this_admin_whs);

            $manager->persist($new_admin);

        	
    	}

        
        $manager->flush();
    }


    public function getOrder()
    {

        return 9;
    }
}