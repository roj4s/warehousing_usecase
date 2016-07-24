<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Warehouse
 *
 * @ORM\Table(name="warehouse")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\WarehouseRepository")
 */
class Warehouse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=100, unique=true)
     */
    private $label;


    /**
    *  @ORM\OneToMany(targetEntity="Pallet", mappedBy="warehouseCurrent") 
    */
    private $pallets_current;

     /**
    *  @ORM\OneToMany(targetEntity="Log", mappedBy="warehouseSource") 
    */
    private $logs_source;

    /**
    *  @ORM\OneToMany(targetEntity="Log", mappedBy="warehouseDestiny") 
    */
    private $logs_destiny;


    /**
    *  @ORM\OneToMany(targetEntity="Pallet", mappedBy="warehouseDestiny") 
    */
    private $pallets_arriving;


    /**
    *  @ORM\OneToMany(targetEntity="Master", mappedBy="warehouseCurrent") 
    */
    private $masters_current;

    /**
    *  @ORM\OneToMany(targetEntity="WarehouseLimits", mappedBy="warehouseOrigin") 
    */
    private $warehouses_limit_origin;

    /**
    *  @ORM\OneToMany(targetEntity="WarehouseLimits", mappedBy="warehouseTarget") 
    */
    private $warehouses_limit_target;


    /**
    *  @ORM\OneToMany(targetEntity="Master", mappedBy="warehouseDestiny") 
    */
    private $masters_arriving;


    /**
    *  @ORM\OneToMany(targetEntity="Imei", mappedBy="warehouseCurrent") 
    */
    private $imeis_current;


    /**
    *  @ORM\OneToMany(targetEntity="Imei", mappedBy="warehouseDestiny") 
    */
    private $imeis_arriving;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Warehouse
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }


    public function __construct()
    {
        $this->pallets_current = new ArrayCollection();
        $this->pallets_arriving = new ArrayCollection();
         $this->masters_current = new ArrayCollection();
        $this->masters_arriving = new ArrayCollection();
        $this->imeis_current = new ArrayCollection();
        $this->imeis_arriving = new ArrayCollection();
        $this->warehouses_limit_origin = new ArrayCollection();
        $this->warehouses_limit_target =  new ArrayCollection();
        $this->logs_source =  new ArrayCollection();
        $this->logs_destiny =  new ArrayCollection();
    }


    /**
     * Add palletsCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $palletsCurrent
     *
     * @return Warehouse
     */
    public function addPalletsCurrent(\Warehousing\WHBundle\Entity\Pallet $palletsCurrent)
    {
        $this->pallets_current[] = $palletsCurrent;

        return $this;
    }

    /**
     * Remove palletsCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $palletsCurrent
     */
    public function removePalletsCurrent(\Warehousing\WHBundle\Entity\Pallet $palletsCurrent)
    {
        $this->pallets_current->removeElement($palletsCurrent);
    }

    /**
     * Get palletsCurrent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPalletsCurrent()
    {
        return $this->pallets_current;
    }

    /**
     * Add logsSource
     *
     * @param \Warehousing\WHBundle\Entity\Log $logsSource
     *
     * @return Warehouse
     */
    public function addLogsSource(\Warehousing\WHBundle\Entity\Log $logsSource)
    {
        $this->logs_source[] = $logsSource;

        return $this;
    }

    /**
     * Remove logsSource
     *
     * @param \Warehousing\WHBundle\Entity\Log $logsSource
     */
    public function removeLogsSource(\Warehousing\WHBundle\Entity\Log $logsSource)
    {
        $this->logs_source->removeElement($logsSource);
    }

    /**
     * Get logsSource
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogsSource()
    {
        return $this->logs_source;
    }

    /**
     * Add logsDestiny
     *
     * @param \Warehousing\WHBundle\Entity\Log $logsDestiny
     *
     * @return Warehouse
     */
    public function addLogsDestiny(\Warehousing\WHBundle\Entity\Log $logsDestiny)
    {
        $this->logs_destiny[] = $logsDestiny;

        return $this;
    }

    /**
     * Remove logsDestiny
     *
     * @param \Warehousing\WHBundle\Entity\Log $logsDestiny
     */
    public function removeLogsDestiny(\Warehousing\WHBundle\Entity\Log $logsDestiny)
    {
        $this->logs_destiny->removeElement($logsDestiny);
    }

    /**
     * Get logsDestiny
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogsDestiny()
    {
        return $this->logs_destiny;
    }

    /**
     * Add palletsArriving
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $palletsArriving
     *
     * @return Warehouse
     */
    public function addPalletsArriving(\Warehousing\WHBundle\Entity\Pallet $palletsArriving)
    {
        $this->pallets_arriving[] = $palletsArriving;

        return $this;
    }

    /**
     * Remove palletsArriving
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $palletsArriving
     */
    public function removePalletsArriving(\Warehousing\WHBundle\Entity\Pallet $palletsArriving)
    {
        $this->pallets_arriving->removeElement($palletsArriving);
    }

    /**
     * Get palletsArriving
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPalletsArriving()
    {
        return $this->pallets_arriving;
    }

    /**
     * Add matersCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Master $matersCurrent
     *
     * @return Warehouse
     */
    public function addMatersCurrent(\Warehousing\WHBundle\Entity\Master $matersCurrent)
    {
        $this->maters_current[] = $matersCurrent;

        return $this;
    }

    /**
     * Remove matersCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Master $matersCurrent
     */
    public function removeMatersCurrent(\Warehousing\WHBundle\Entity\Master $matersCurrent)
    {
        $this->maters_current->removeElement($matersCurrent);
    }

    /**
     * Get matersCurrent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatersCurrent()
    {
        return $this->maters_current;
    }

    /**
     * Add warehousesLimitOrigin
     *
     * @param \Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitOrigin
     *
     * @return Warehouse
     */
    public function addWarehousesLimitOrigin(\Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitOrigin)
    {
        $this->warehouses_limit_origin[] = $warehousesLimitOrigin;

        return $this;
    }

    /**
     * Remove warehousesLimitOrigin
     *
     * @param \Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitOrigin
     */
    public function removeWarehousesLimitOrigin(\Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitOrigin)
    {
        $this->warehouses_limit_origin->removeElement($warehousesLimitOrigin);
    }

    /**
     * Get warehousesLimitOrigin
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarehousesLimitOrigin()
    {
        return $this->warehouses_limit_origin;
    }

    /**
     * Add warehousesLimitTarget
     *
     * @param \Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitTarget
     *
     * @return Warehouse
     */
    public function addWarehousesLimitTarget(\Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitTarget)
    {
        $this->warehouses_limit_target[] = $warehousesLimitTarget;

        return $this;
    }

    /**
     * Remove warehousesLimitTarget
     *
     * @param \Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitTarget
     */
    public function removeWarehousesLimitTarget(\Warehousing\WHBundle\Entity\WarehouseLimits $warehousesLimitTarget)
    {
        $this->warehouses_limit_target->removeElement($warehousesLimitTarget);
    }

    /**
     * Get warehousesLimitTarget
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarehousesLimitTarget()
    {
        return $this->warehouses_limit_target;
    }

    /**
     * Add mastersArriving
     *
     * @param \Warehousing\WHBundle\Entity\Master $mastersArriving
     *
     * @return Warehouse
     */
    public function addMastersArriving(\Warehousing\WHBundle\Entity\Master $mastersArriving)
    {
        $this->masters_arriving[] = $mastersArriving;

        return $this;
    }

    /**
     * Remove mastersArriving
     *
     * @param \Warehousing\WHBundle\Entity\Master $mastersArriving
     */
    public function removeMastersArriving(\Warehousing\WHBundle\Entity\Master $mastersArriving)
    {
        $this->masters_arriving->removeElement($mastersArriving);
    }

    /**
     * Get mastersArriving
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMastersArriving()
    {
        return $this->masters_arriving;
    }

    /**
     * Add imeisCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imeisCurrent
     *
     * @return Warehouse
     */
    public function addImeisCurrent(\Warehousing\WHBundle\Entity\Imei $imeisCurrent)
    {
        $this->imeis_current[] = $imeisCurrent;

        return $this;
    }

    /**
     * Remove imeisCurrent
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imeisCurrent
     */
    public function removeImeisCurrent(\Warehousing\WHBundle\Entity\Imei $imeisCurrent)
    {
        $this->imeis_current->removeElement($imeisCurrent);
    }

    /**
     * Get imeisCurrent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImeisCurrent()
    {
        return $this->imeis_current;
    }

    /**
     * Add imeisArriving
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imeisArriving
     *
     * @return Warehouse
     */
    public function addImeisArriving(\Warehousing\WHBundle\Entity\Imei $imeisArriving)
    {
        $this->imeis_arriving[] = $imeisArriving;

        return $this;
    }

    /**
     * Remove imeisArriving
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imeisArriving
     */
    public function removeImeisArriving(\Warehousing\WHBundle\Entity\Imei $imeisArriving)
    {
        $this->imeis_arriving->removeElement($imeisArriving);
    }

    /**
     * Get imeisArriving
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImeisArriving()
    {
        return $this->imeis_arriving;
    }
}
