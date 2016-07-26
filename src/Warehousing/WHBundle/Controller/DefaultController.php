<?php

namespace Warehousing\WHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {	
    	
        $this->resetSession($this->get('session'));

        $admins = $this->getDoctrine()->getRepository("WHBundle:Admin")->findAll();
    	shuffle($admins);
    	$warehouses = $admins[0]->getWarehouses();


        return $this->render('WHBundle:Default:index.html.twig', array('warehouses' => $warehouses));

    }

    private function resetSession($session){


        $session->set('working_warehouse', -1);        

        $doctrine = $this->getDoctrine()->getManager();
        $locked_repository = $doctrine->getRepository("WHBundle:Locked");

        $stack = $session->get("stack", array());

        foreach ($stack as $id) {
            
            $locked = $locked_repository->find($id);
            $table = $locked->getTableName();
            $table_id = $locked->getTableId();

            switch ($table) {
                case 'imei':
                    $imei = $doctrine->getRepository("WHBundle:Imei")->find($table_id);
                    $imei->setLocked(0);
                    $doctrine->persist($imei);
                    $doctrine->flush();
                    break;
                
                case 'master':
                    $master = $doctrine->getRepository("WHBundle:Master")->find($table_id);
                    $master->setLocked(0);
                    $doctrine->persist($master);
                    $doctrine->flush();
                    break;

                case 'pallet':
                    $pallet = $doctrine->getRepository("WHBundle:Pallet")->find($table_id);
                    $pallet->setLocked(0);
                    $doctrine->persist($pallet);
                    $doctrine->flush();
                    break;

                default:
                    break;
            }

            $doctrine->remove($locked);
            $doctrine->flush();

        }

        $session->set('stack', array());

    }


    /**
    * @Route("/api/submit/{destiny}/{transporter_id}")
    */
    public function submitCurrentShipmentAction($destiny, $trasporter_id, Request $request){
        // error types would be better hard coded though.

        $resp = new JsonResponse();
        $working_warehouse = $session->get('working_warehouse', -1);
        $current_cost = $session->get('current_cost', -1);

        if(($working_warehouse == -1) || ($current_cost == -1)){

            $resp->setData(array(
                'ok'=>false,
                'error_type' => 'current_warehouse_or_cost_unknown',
                'msg' => 'Current warehouse or cost unknown.'
                ));
            return $resp;

        }


        $doctrine = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $stack = $session->get("stack", array());
        

        $wh_repo = $doctrine->getRepository('WHBundle:Warehouse');

        $wh_source = $wh_repo->find($working_warehouse);
        $wh_dest = $wh_repo->find($destiny);
        $transporter = $doctrine->getRepository("WHBundle:Transporter")->find($transporter_id);
        

        if(!$wh_dest || !$wh_source || !$transporter){

            $resp->setData(array(
                'ok'=>false,
                'error_type' => 'table_not_found',
                'msg' => 'Some references was not found on database.'
                ));
            return $resp;
        }

        if($working_warehouse == $destiny){

            $resp->setData(array(
                'ok'=>false,
                'error_type' => 'same_warehouse_as_destiny',
                'msg' => 'Cant ship elements to its same warehouse.'
                ));
            return $resp;

        }

        $wh_pair_limit = $doctrine->getRepository("WHBundle:WarehouseLimits")->findOneBy(
            array("warehouseOrigin" => $warehouseOrigin, "warehouseTarget" => $warehouseTarget))->getWhLimit();

        if(!$wh_pair_limit){

            $resp->setData(array(
                'ok'=>false,
                'error_type' => 'wh_limit_not_found',
                'msg' => 'Inter-warehouses limit not found.'
                ));
            return $resp;

        }

        if($current_cost > $wh_pair_limit){

            $resp->setData(array(
                'ok'=>false,
                'error_type' => 'same_warehouses',
                'msg' => "Current cost exeeds the limit for the pair of warehouses selected."
                ));

            return $resp;
        }

        $in_transit_status = $doctrine->getRepository("WHBundle:Status")->findOneBy(array("label"=>"In Transit"));
        
        $log = new Log();
        $log->setWarehouseSource($wh_source);
        $log->setWarehouseDestiny($wh_dest);
        $log->setTransporter($transporter);
        $log->setDate(new \DateTime());

        $doctrine->persist($log);
        $doctine->flush();

        foreach ($stack as $id) {
            
            $locked = $locked_repository->find($id);
            $table = $locked->getTableName();
            $table_id = $locked->getTableId();

            $doctrine->remove($locked);
            $doctrine->flush();

            switch ($table) {
                case 'imei':
                    $imei = $doctrine->getRepository("WHBundle:Imei")->find($table_id);
                    $imei->setWarehouseDestiny($wh_dest);

                    if($imei->getWarehouseCurrent()->getId() == $imei->getWarehouseDestiny()->getId())
                        $imei->setNotTransferable(1);

                    $imei->setLocked(0);
                    $imei->setStatus($in_transit_status);

                    $doctrine->persist($imei);
                    $doctrine->flush();

                    $new_log_desc = new LogDesc();
                    $new_log_desc->setLog($log);
                    $new_log_desc->setImei($imei);
                    $master = $imei->getMaster();
                    $new_log_desc->setMaster($master);
                    $pallet = $master->getPallet();
                    $new_log_desc->setPallet($pallet);

                    $doctrine->persist($new_log_desc);
                    $doctrine->flush();

                    break;
                
                case 'master':
                    $master = $doctrine->getRepository("WHBundle:Master")->find($table_id);
                    $master->setLocked(0);

                    $master->setWarehouseDestiny($wh_dest);
                    $master->setStatus($in_transit_status);

                    if($master->getWarehouseCurrent()->getId() == $master->getWarehouseDestiny()->getId())
                        $master->setNotTransferable(1);


                    $doctrine->persist($master);
                    $doctrine->flush();

                    break;

                case 'pallet':
                    $pallet = $doctrine->getRepository("WHBundle:Pallet")->find($table_id);
                    $pallet->setLocked(0);

                    $pallet->setWarehouseDestiny($wh_dest);
                    $pallet->setStatus($in_transit_status);

                    if($pallet->getWarehouseCurrent()->getId() == $pallet->getWarehouseDestiny()->getId())
                        $pallet->setNotTransferable(1);

                    $doctrine->persist($pallet);
                    $doctrine->flush();
                    break;

                default:
                    break;
            }

        }

    }

    private function currentTransactionValid($destiny){



        $resp = array(
            'ok' => true,
            'msg' => "",
            'error_type' => ""            
                );

        if($warehouseFrom == $warehouseTo){
            $resp['ok'] = false;
            $resp['msg'] = "Warehouse origin cant be the same as warehouse destiny.";
            $resp['error_type'] = 'same_warehouses';
            return $resp;
        }

        $session = $request->getSession();
        $current_cost = $session->get('current_cost', 0);
        $doctrine = $this->getDoctrine()->getManager();
        $wh_repo = $doctrine->getRepository('WHBundle:Warehouse');

        $warehouseOrigin = $wh_repo->find($warehouseFromId);
        $warehouseTarget = $wh_repo->find($warehouseToId);

        $wh_pair_limit = $doctrine->getRepository("WHBundle:WarehouseLimits")->findOneBy(
            array("warehouseOrigin" => $warehouseOrigin, "warehouseTarget" => $warehouseTarget))->getWhLimit();

        if($current_cost > $wh_pair_limit){

            $resp['ok'] = false;
            $resp['msg'] = "Current cost exeeds the limit for the pair of warehouses selected.";
            $resp['error_type'] = 'same_warehouses';
            return $resp;
        }

        return $resp;

    }

    public function registerLocked($table, $id, $session){

        $doctrine = $this->getDoctrine()->getManager();
        $stack = $session->get("stack", array());

        $new_locked = new Locked();
        $new_locked->setTableName($table);
        $new_locked->setTableId($id);

        $doctrine->persist($new_locked);
        $doctrine->flush();

        array_push($stack, $new_locked->getId());
        $session->set('stack', $stack);

    }

    public function updateCost($table, $table_id, $session){     

       // Lack error handling. Sorry ;)


        $cost = $session->get('current_cost',0);
        $doctrine = $this->getDoctrine()->getManager();

        switch ($table) {
            case 'imei':

                $imei = $doctrine->getRepository("WHBundle:Imei")->find($table_id);
                if(!$imei->isLocked())
                    $cost = $imei->getProduct()->getUnitaryPrice();
                break;

            case 'master':                

                $master = $doctrine->getRepository("WHBundle:Master")->find($table_id);
                if(!$master->isLocked()){
                    foreach ($master->getImeis() as $imei) {
                        
                        if(!$imei->isLocked())
                            $cost += $imei->getProduct()->getUnitaryPrice();
                        
                    }
                }

            case 'pallet':

                $pallet = $doctrine->getRepository("WHBundle:Pallet")->find($table_id);
                if(!$pallet->isLocked()){
                    foreach ($pallet->getMasters() as $master) {

                        if(!$master->isLocked()){
                            foreach ($master->getImeis() as $imei) {
                            
                                if(!$imei->isLocked())
                                    $cost += $imei->getProduct()->getUnitaryPrice();
                        
                                }
                    }
                }
            }

            default:
                break;
        }

        $session-set('cost', $cost);

    }


    private function isInSameWarehouse($obj, $session){

        $working_warehouse = $session->get('working_warehouse',-1);
        $obj_warehouse = $obj->getWarehouseCurrent()->getId();

        if($working_warehouse != -1){
            if( $obj_warehouse == $working_warehouse){
                
                return true;

            }
        }

        if($working_warehouse == -1){
           $session->set('working_warehouse', $obj_warehouse);
           return true;
        }

       return false;

    }

    /**
    * @Route("/api/delelement/{table}/{id}")
    */
    public function delElementAction($table, $id, Request $request){

        $doctrine = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $resp = new JsonResponse();

        $current_cost = $session->get('current_cost',0);

        $unlock_those_elements_on_view = array();

        $locked_repository = $doctrine->getRepository("WHBundle:Locked");
        $locked = $locked_repository->findOneBy(array(
            "table_name" => $table,
             "table_id" => $id
             ));

        if(!$locked)
            {
               $resp->setData(array(
                "ok" => false,
                "error_type" => "tuple_not_found",
                "msg" => "Element not marked for shipment."
                ));
                return $resp; 
            }

        $locked_id = $locked->getId();        
        $stack = $session->get('stack', array());

        if(count($stack) == 0){
            $resp->setData(array(
                    "ok" => false,
                    "error_type" => "nothing_on_stack",
                    "msg" => "Nothing marked to ship."
                    ));
                    return $resp; 
        }

        $to_remove = array($locked_id);
        $stack = array_diff($stack, $to_remove);
        

        switch ($locked->getTableName()) {
            case 'imei':
                $imei = $doctrine->getRepository("WHBundle:Imei")->find($locked->getTableId());
                $imei->setLocked(0);
                $doctrine->persist($imei);
                $doctrine->flush();
                array_push($unlock_those_elements_on_view, array(
                    "table_name"=>"imei",
                     "table_id"=>$locked->getTableId()));
                $current_cost -= $imei->getProduct()->getUnitaryPrice();

            case 'master':
                $master = $doctrine->getRepository("WHBundle:Master")->find($locked->getTableId());
                $master->setLocked(0);

                array_push($unlock_those_elements_on_view, array(
                    "table_name"=>"master",
                     "table_id"=>$locked->getTableId()));

                $doctrine->persist($master);
                $doctrine->flush();

                foreach ($master->getImeis() as $imei) {

                    $imei_locked = $locked_repository->findOneBy(array(
                        "table_name"=>"imei",
                         "table_id"=>$imei->getId()));
                    
                    if($imei_locked){
                        
                        array_push($unlock_those_elements_on_view, array(
                            "table_name"=>"imei",
                             "table_id"=>$imei->getId()
                            ));

                        $to_remove = array($imei_locked->getId());
                        $stack = array_diff($stack, $to_remove);

                        $doctrine->remove($imei_locked);
                        $doctrine->flush();

                        $imei->setLocked(0);
                        $doctrine->persist($imei);
                        $doctrine->flush();

                        $current_cost -= $imei->getProduct()->getUnitaryPrice();

                    }
                }
                break;

            case 'pallet':

                $pallet = $doctrine->getRepository("WHBundle:Pallet")->find($locked->getTableId());
                $pallet->setLocked(0);

                $doctrine->persist($pallet);
                $doctrine->flush();

                array_push($unlock_those_elements_on_view, array(
                    "table_name"=>"pallet",
                     "table_id"=>$locked->getTableId()));

                foreach ($pallet->getMasters() as $master) {

                    $_locked_master = $locked_repository->findOneBy(array(
                            "table_name"=>"master",
                             "table_id"=>$master->getId()));

                    if($_locked_master){

                        $to_remove = array($_locked_master->getId());
                        $stack = array_diff($stack, $to_remove);

                        $doctrine->remove($_locked_master);
                        $doctrine->flush();

                        $master->setLocked(0);
                        $doctrine->persist($master);
                        $doctrine->flush();

                        array_push($unlock_those_elements_on_view, array(
                            "table_name"=>"master",
                             "table_id"=>$master->getId()
                             ));

                    }
                 
                    foreach ($master->getImeis() as $imei) {

                        $imei_locked = $locked_repository->findOneBy(array(
                            "table_name"=>"imei",
                             "table_id"=>$imei->getId()));
                        
                        if($imei_locked){
                            
                            $to_remove = array($imei_locked->getId());
                            $stack = array_diff($stack, $to_remove);

                            $doctrine->remove($imei_locked);
                            $doctrine->flush();

                            $imei->setLocked(0);
                            $doctrine->persist($imei);
                            $doctrine->flush();

                            array_push($unlock_those_elements_on_view, array(
                                "table_name"=>"imei",
                                 "table_id"=>$imei->getId()
                                 ));

                            $current_cost -= $imei->getProduct()->getUnitaryPrice();

                        }
                    }
            }
            
            default:
                # code...
                break;
        }

        $session->set('stack', $stack);
        $session->set('current_cost', $current_cost);

        $doctrine->remove($locked);
        $doctrine->flush();

        $resp->setData(array(
                    "ok" => true,
                    "error_type" => "",
                    "current_cost" => $current_cost,
                    "msg" => "Elements unmarked from shipment.",
                    "unlock_this" => $unlock_those_elements_on_view
                    ));
        return $resp;

    }

    /**
    * @Route("/api/addelement/{table}/{id}")
    */
    public function addElementAction($table, $id, Request $request)
    {
        // Security not handled.

        $doctrine = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        

        $resp = new JsonResponse();
        $warehouse_code = "";
        $warehouse_id = -1;
        $master_code = "*";
        $master_id = -1;
        $pallet_code = "*";
        $pallet_id = -1;
        $imei_code = "*";
        $ok = true;
        $msg = "Items added correctly";

        $locked_repository = $doctrine->getRepository("WHBundle:Locked");

        switch ($table) {
            case "imei":
                
                $imei = $doctrine->getRepository("WHBundle:Imei")->find($id);
                
                if(!$imei)
                {
                   $resp->setData(array(
                    "ok" => false,
                    "error_type" => "tuple_not_found",
                    "msg" => "Tuple not found. Table: ".$table." Id: ".$id
                    ));
                    return $resp; 
                }

                                
                if ($imei->isLocked() || $imei->isNotTransferable()){

                    $resp->setData(array(
                    "ok" => false,
                    "error_type" => "locked",
                    "msg" => "This item is locked."
                    ));
                    return $resp;
                }

                if( !$this->isInSameWarehouse($imei, $session) ){

                    $resp->setData(array(
                        "ok" => false,
                        "error_type" => "different_warehouse",
                        "msg" => "Cant add elements from different warehouses."
                        ));

                    return $resp;

                }

                $imei->setLocked(1);

                $imei_code = $imei->getCode();
                $master = $imei->getMaster();
                $master_code = $master->getCode();
                $pallet = $master->getPallet();
                $pallet_code = $pallet->getCode();
                $warehouse = $pallet->getWarehouseCurrent();
                $warehouse_code = $warehouse->getLabel();

                $doctrine->persist($imei);

                $this->registerLocked($table, $id, $session);

                $this->updateCost($table, $table_id, $session);

                break;

            case "master":
                
                    $master = $this->getDoctrine()->getRepository("WHBundle:Master")->find($id);
                    
                    if(!$master)
                    {
                       $resp->setData(array(
                        "ok" => false,
                        "error_type" => "tuple_not_found",
                        "msg" => "Tuple not found. Table: ".$table." Id: ".$id
                        ));
                        return $resp; 
                    }

                    if ($master->isLocked() || $imei->isNotTransferable()){

                        $resp->setData(array(
                        "ok" => false,
                        "error_type" => "locked",
                        "msg" => "This item is locked."
                        ));
                        return $resp;
                    }

                    if( !$this->isInSameWarehouse($master, $session) ){

                    $resp->setData(array(
                        "ok" => false,
                        "error_type" => "different_warehouse",
                        "msg" => "Cant add elements from different warehouses."
                        ));

                    return $resp;

                    }


                    $master_code = $master->getCode();
                    $pallet = $master->getPallet();
                    $pallet_code = $pallet->getCode();
                    $warehouse = $pallet->getWarehouseCurrent();
                    $warehouse_code = $warehouse->getLabel();

                    foreach ($master->getImeis() as $imei) {

                        if((!$imei->isLocked() || !$imei->isNotTransferable()) && $imei->getStatus()->getLabel() == "In Stock"){
                            $imei->setLocked(1);
                            $doctrine->persist($imei);
                            $doctrine->flush();
                            $this->registerLocked('imei', $imei->getId(), $session);
                        }
                        

                    }

                    $master->setLocked(1);
                    $doctrine->persist($master);
                    $doctrine->flush();

                    $this->registerLocked('master', $master->getId(), $session);
                    $this->updateCost($table, $table_id, $session);

                break;

                case "pallet":
                
                        $pallet = $this->getDoctrine()->getRepository("WHBundle:Pallet")->find($id);

                        if(!$pallet)
                        {
                           $resp->setData(array(
                            "ok" => false,
                            "error_type" => "tuple_not_found",
                            "msg" => "Tuple not found. Table: ".$table." Id: ".$id
                            ));
                            return $resp; 
                        }
                        
                        if ($pallet->isLocked() || $pallet->isNotTransferable()){

                            $resp->setData(array(
                            "ok" => false,
                            "error_type" => "locked",
                            "msg" => "This item is locked."
                            ));
                            return $resp;
                        }

                        if( !$this->isInSameWarehouse($pallet, $session) ){

                            $resp->setData(array(
                                "ok" => false,
                                "error_type" => "different_warehouse",
                                "msg" => "Cant add elements from different warehouses."
                                ));

                            return $resp;

                        }

                        
                        $pallet_code = $pallet->getCode();
                        $warehouse = $pallet->getWarehouseCurrent();
                        $warehouse_code = $warehouse->getLabel();

                        foreach ($pallet->getMasters() as $master)  {

                            if((!$master->isLocked() || !$master->isNotTransferable()) && $master->getStatus()->getLabel() == "In Stock"){
                                $master->setLocked(1);
                                $doctrine->persist($master);
                                $this->registerLocked('master', $master->getId(), $session);
                            }

                            
                            foreach ($master->getImeis() as $imei) {

                                if((!$imei->isLocked() || !$imei->isNotTransferable()) && $imei->getStatus()->getLabel() == "In Stock"){

                                    $imei->setLocked(1);
                                    $doctrine->persist($imei);
                                    $doctrine->flush();
                                    $this->registerLocked('imei', $imei->getId(), $session);
                                }
                            }
                        }

                        $pallet->setLocked(1);
                        $doctrine->persist($pallet);
                        $doctrine->flush();

                        $this->registerLocked('pallet', $pallet->getId(), $session);
                        $this->updateCost($table, $table_id, $session);

                break;
            
            default:
                $resp->setData(array(
                "ok" => false,
                "error_type" => "table_not_found",
                "msg" => "Specified table: ".$table." not found."
                ));
                return $resp;

                break;
        }

        $resp->setData(array(
            "ok" => $ok,
            "msg" => $msg,
            "warehouse" => $warehouse_code,
            "pallet" => $pallet_code,
            "master" => $master_code,
            "imei" => $imei_code
            ));

        return $resp;

    }
}
