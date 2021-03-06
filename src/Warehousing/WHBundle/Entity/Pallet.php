<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pallet
 *
 * @ORM\Table(name="pallet")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\PalletRepository")
 */
class Pallet
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
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="pallets_current")
     * @ORM\JoinColumn(name="warehouse_current_id", referencedColumnName="id") 
     */
    private $warehouseCurrent;

    /**
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="pallets_arriving")
     * @ORM\JoinColumn(name="warehouse_destiny_id", referencedColumnName="id")
     */
    private $warehouseDestiny;

       /**
    *  @ORM\OneToMany(targetEntity="LogDesc", mappedBy="pallet") 
    */
    private $log_items;

     /**
    *  @ORM\OneToMany(targetEntity="Master", mappedBy="pallet") 
    */
    private $masters;

    /**
    * @ORM\ManyToOne(targetEntity="Status", inversedBy="pallets")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="locked", type="integer")
     */
    private $locked;

    /**
     * Is locked
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked == 1;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="not_transferable", type="integer")
     */
    private $not_transferable;

     /**
     * Get transferable
     *
     * @return boolean
     */
    public function isNotTransferable()
    {
        return $this->not_transferable == 1;
    }

    /**
     * Set locked
     *
     * @param integer $locked
     *
     * @return Pallet
     */
    public function setLocked($locked){
        $this->locked = $locked;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;


    public function __construct()
    {
        $this->masters = new ArrayCollection();
    }

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
     * Set warehouseCurrent
     *
     * @param integer $warehouseCurrent
     *
     * @return Pallet
     */
    public function setWarehouseCurrent($warehouseCurrent)
    {
        $this->warehouseCurrent = $warehouseCurrent;

        return $this;
    }

    /**
     * Get warehouseCurrent
     *
     * @return int
     */
    public function getWarehouseCurrent()
    {
        return $this->warehouseCurrent;
    }

    /**
     * Set warehouseDestiny
     *
     * @param integer $warehouseDestiny
     *
     * @return Pallet
     */
    public function setWarehouseDestiny($warehouseDestiny)
    {
        $this->warehouseDestiny = $warehouseDestiny;

        return $this;
    }

    /**
     * Get warehouseDestiny
     *
     * @return int
     */
    public function getWarehouseDestiny()
    {
        return $this->warehouseDestiny;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Pallet
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Pallet
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add logItem
     *
     * @param \Warehousing\WHBundle\Entity\LogDesc $logItem
     *
     * @return Pallet
     */
    public function addLogItem(\Warehousing\WHBundle\Entity\LogDesc $logItem)
    {
        $this->log_items[] = $logItem;

        return $this;
    }

    /**
     * Remove logItem
     *
     * @param \Warehousing\WHBundle\Entity\LogDesc $logItem
     */
    public function removeLogItem(\Warehousing\WHBundle\Entity\LogDesc $logItem)
    {
        $this->log_items->removeElement($logItem);
    }

    /**
     * Get logItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogItems()
    {
        return $this->log_items;
    }

    /**
     * Add master
     *
     * @param \Warehousing\WHBundle\Entity\Master $master
     *
     * @return Pallet
     */
    public function addMaster(\Warehousing\WHBundle\Entity\Master $master)
    {
        $this->masters[] = $master;

        return $this;
    }

    /**
     * Remove master
     *
     * @param \Warehousing\WHBundle\Entity\Master $master
     */
    public function removeMaster(\Warehousing\WHBundle\Entity\Master $master)
    {
        $this->masters->removeElement($master);
    }

    /**
     * Get masters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMasters()
    {
        return $this->masters;
    }

    /**
     * Get locked
     *
     * @return integer
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set notTransferable
     *
     * @param integer $notTransferable
     *
     * @return Pallet
     */
    public function setNotTransferable($notTransferable)
    {
        $this->not_transferable = $notTransferable;

        return $this;
    }

    /**
     * Get notTransferable
     *
     * @return integer
     */
    public function getNotTransferable()
    {
        return $this->not_transferable;
    }
}
