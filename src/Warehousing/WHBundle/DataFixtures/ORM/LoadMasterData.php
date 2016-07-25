<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Master;

class LoadMasterData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $pallets = $manager->getRepository("WHBundle:Pallet")->findAll();

    	$m_with_equal_src_and_dest = rand(4, 10);

    	for ($i=0; $i <500 ; $i++) { 
    		
    		$new_master = $this->generate_a_master($pallets);
            $new_master->setStatus($manager->getRepository("WHBundle:Status")->findOneByLabel("In Stock"));
            if($new_master->getPallet()->getStatus()->getLabel() == "In Transit")
                $new_master->setStatus($manager->getRepository("WHBundle:Status")->findOneByLabel("In Transit"));

        	
        	
        	if($m_with_equal_src_and_dest > 0){

        		// Intentionaly inserting some Masters with warehouse_current = warehouse_destiny
        		$new_master->setWarehouseDestiny($new_master->getWarehouseCurrent());
                $new_master->setLocked(1);
        		$m_with_equal_src_and_dest--;
        	}

            $manager->persist($new_master);

        	
    	}

        
        $manager->flush();
    }

    private function generate_a_master($pallets){

    	$new_master = new Master();
        $new_master->setLocked(0);
        $random_code = "M_" . base64_encode(random_bytes(6));
        $new_master->setCode($random_code);
        shuffle($pallets);
        $new_master->setPallet($pallets[0]);
        if($new_master->getPallet()->isLocked())
            $new_master->setLocked(1);
        $new_master->setWarehouseCurrent($pallets[0]->getWarehouseCurrent());
        
        return $new_master;
    }

    public function getOrder()
    {

        return 6;
    }
}
