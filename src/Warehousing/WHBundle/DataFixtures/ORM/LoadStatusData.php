<?php
namespace WHBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Warehousing\WHBundle\Entity\Status;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

    	$status_in_transit = new Status();
        $status_in_transit->setLabel("In Transit");
        $manager->persist($status_in_transit);

        $status_in_stock = new Status();
        $status_in_stock->setLabel("In Stock");
        $manager->persist($status_in_stock);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}