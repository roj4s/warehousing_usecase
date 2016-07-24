<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Imei;

class LoadImeiData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	$status = $manager->getRepository("WHBundle:Status")->findAll();
        $masters = $manager->getRepository("WHBundle:Master")->findAll();
        $products = $manager->getRepository("WHBundle:Product")->findAll();

    	$im_with_equal_src_and_dest = rand(4, 10);

    	for ($i=0; $i <40 ; $i++) { 
    		
    		$new_imei = $this->generate_a_imei($masters, $status, $products);
        	
        	
        	if($im_with_equal_src_and_dest > 0){

        		// Intentionaly inserting some Masters with warehouse_current = warehouse_destiny
        		$new_imei->setWarehouseDestiny($new_imei->getWarehouseCurrent());
        		$im_with_equal_src_and_dest--;
        	}

            $manager->persist($new_imei);

        	
    	}

        
        $manager->flush();
    }

    private function generate_a_imei($masters, $status, $products){

    	$new_imei = new Imei();
        $random_code = "Im_" . base64_encode(random_bytes(6));
        $new_imei->setCode($random_code);
        shuffle($masters);
        shuffle($status);
        shuffle($products);
        $new_imei->setMaster($masters[0]);
        $new_imei->setProduct($products[0]);
        $new_imei->setWarehouseCurrent($masters[0]->getWarehouseCurrent());
        $new_imei->setStatus($status[0]);
        return $new_imei;
    }

    public function getOrder()
    {

        return 7;
    }
}
