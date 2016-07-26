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

        $masters = $manager->getRepository("WHBundle:Master")->findAll();
        $products = $manager->getRepository("WHBundle:Product")->findAll();

    	$im_with_equal_src_and_dest = rand(4, 10);

    	for ($i=0; $i <1000 ; $i++) { 
    		
    		$new_imei = $this->generate_a_imei($masters, $products);
            $new_imei->setStatus($manager->getRepository("WHBundle:Status")->findOneByLabel("In Stock"));

            if($new_imei->getMaster()->getStatus()->getLabel() == "In Transit")
                $new_imei->setStatus($manager->getRepository("WHBundle:Status")->findOneByLabel("In Transit"));
        	
        	
        	if($im_with_equal_src_and_dest > 0){

        		// Intentionaly inserting some Masters with warehouse_current = warehouse_destiny
        		$new_imei->setWarehouseDestiny($new_imei->getWarehouseCurrent());
                $new_imei->setLocked(1);
        		$im_with_equal_src_and_dest--;
        	}

            $manager->persist($new_imei);

        	
    	}

        
        $manager->flush();
    }

    private function generate_a_imei($masters, $products){

    	$new_imei = new Imei();
        $new_imei->setNotTransferable(0);    
        $new_imei->setLocked(0);    
        $random_code = "Im_" . base64_encode(random_bytes(6));
        $new_imei->setCode($random_code);

        shuffle($masters);
        shuffle($products);

        $new_imei->setMaster($masters[0]);
        

        if($new_imei->getMaster()->isLocked())
            $new_imei->setLocked(1);

        $new_imei->setProduct($products[0]);
        $new_imei->setWarehouseCurrent($masters[0]->getWarehouseCurrent());
        
        return $new_imei;
    }

    public function getOrder()
    {

        return 7;
    }
}
