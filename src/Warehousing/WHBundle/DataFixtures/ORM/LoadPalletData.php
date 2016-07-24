<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Pallet;

class LoadPalletData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	$some_warehouses = $manager->getRepository("WHBundle:Warehouse")->findAll();
    	$status = $manager->getRepository("WHBundle:Status")->findAll();

    	$p_with_equal_src_and_dest = rand(4, 10);

    	for ($i=0; $i <20 ; $i++) { 
    		
    		$new_pallet = $this->generate_a_pallet($some_warehouses, $status);
        	
        	
        	if($p_with_equal_src_and_dest > 0){

        		// Intentionaly inserting some Pallets with warehouse_current = warehouse_destiny
        		$new_pallet->setWarehouseDestiny($new_pallet->getWarehouseCurrent());
        		$p_with_equal_src_and_dest--;
        	}

            $manager->persist($new_pallet);
        	
    	}

        
        $manager->flush();
    }

    private function generate_a_pallet($some_warehouses, $status){

    	$new_pallet = new Pallet();
        $random_code = "P_" . base64_encode(random_bytes(6));
        $new_pallet->setCode($random_code);
        shuffle($some_warehouses);
        shuffle($status);
        $new_pallet->setWarehouseCurrent($some_warehouses[0]);
        $new_pallet->setStatus($status[0]);
        return $new_pallet;
    }

    public function getOrder()
    {

        return 5;
    }
}
