<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Transporter;

class LoadTransporterData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	for ($i=0; $i <20 ; $i++) { 
    		
    		$new_transporter = new Transporter();
        	$random_label = "T_" . base64_encode(random_bytes(6));
        	$new_transporter->setLabel($random_label);
        

        	$manager->persist($new_transporter);
    	}
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}