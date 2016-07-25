<?php

namespace Warehousing\WHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {	
    	$admins = $this->getDoctrine()->getRepository("WHBundle:Admin")->findAll();
    	shuffle($admins);
    	$warehouses = $admins[0]->getWarehouses();


        return $this->render('WHBundle:Default:index.html.twig', array('warehouses' => $warehouses));

        /*$resp = new JsonResponse();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT i
            FROM WHBundle:Imei i
            WHERE i.id = :id'
            )->setParameter('id', 1);

            $products = $query->getResult();
         if(!$products)
                {
                   $resp->setData(array("found" => false));
                    return $resp; 
                }*/

    }

    /**
    * @Route("/api/lock_element/{table}/{id}")
    */
    public function lockElementAction($table, $id)
    {
        // Security not handled.

        $doctrine = $this->getDoctrine()->getManager();

        $resp = new JsonResponse();
        $warehouse_code = "";
        $master_code = "*";
        $pallet_code = "*";
        $imei_code = "*";

        switch ($table) {
            case "imei":
                
                $imei = $doctrine->getRepository("WHBundle:Imei")->findOneBy(array("id"=>1));
                if(!$imei)
                {
                   $resp->setData(array("found" => false));
                    return $resp; 
                }

                                
                if ($imei->isLocked()){
                    $resp->setData(array("was_locked_already" => true));
                    return $resp;
                }

                $imei->setLocked(1);

                $master = $imei->getMaster();
                $master_code = $master->getCode();
                $pallet = $master->getPallet();
                $pallet_code = $pallet->getCode();
                $warehouse = $pallet->getWarehouse();
                $warehouse_code = $warehouse->getLabel();

                break;

            /*case "master":
                
                $master = $this->getDoctrine()->getRepository("WHBundle:Master")->findOneById($id);
                
                if ($master->isLocked()){
                    $resp->setData(array("was_locked_already" => true));
                    return $resp;
                }

                $master_code = $master->getCode();
                $pallet = $master->getPallet();
                $pallet_code = $pallet->getCode();
                $warehouse = $pallet->getWarehouse();
                $warehouse_code = $warehouse->getLabel();

                foreach ($master->getImeis() as $imei) {
                    $imei->setLocked(1);
                }
                break;

                case "pallet":
                
                $pallet = $this->getDoctrine()->getRepository("WHBundle:Pallet")->findOneById($id);
                
                if ($pallet->isLocked()){
                    $resp->setData(array("was_locked_already" => true));
                    return $resp;
                }

                $pallet_code = $pallet->getCode();
                $warehouse = $pallet->getWarehouse();
                $warehouse_code = $warehouse->getLabel();

                foreach ($pallet->getMasters() as $master)  {
                    $master->setLocked(1);
                    foreach ($master->getImeis() as $imei) {
                        $imei->setLocked(1);
                    }
                }
                break;*/
            
            default:
                # code...
                break;
        }

        $resp->setData(array(
            "was_locked_already" => false,
            "warehouse" => $warehouse_code,
            "pallet" => $pallet_code,
            "master" => $master_code,
            "imei" => $imei_code
            ));
        return $resp;

    }
}
