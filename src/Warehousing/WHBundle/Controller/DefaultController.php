<?php

namespace Warehousing\WHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {	
    	$warehouses = $this->getDoctrine()->getRepository("WHBundle:Warehouse")->findAll();
        return $this->render('WHBundle:Default:index.html.twig', array('warehouses' => $warehouses));
    }
}
