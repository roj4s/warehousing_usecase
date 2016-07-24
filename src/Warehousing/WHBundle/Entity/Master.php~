<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Master
 *
 * @ORM\Table(name="master")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\MasterRepository")
 */
class Master
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
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="masters_current")
     * @ORM\JoinColumn(name="warehouse_current_id", referencedColumnName="id") 
     */
    private $warehouseCurrent;

    /**
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="masters_arriving")
     * @ORM\JoinColumn(name="warehouse_destiny_id", referencedColumnName="id")
     */
    private $warehouseDestiny;

     /**
    *  @ORM\OneToMany(targetEntity="Imei", mappedBy="master") 
    */
    private $imeis;

    /**
    *  @ORM\OneToMany(targetEntity="LogDesc", mappedBy="master") 
    */
    private $log_items;

    /**
     * @ORM\ManyToOne(targetEntity="Pallet", inversedBy="masters")
     * @ORM\JoinColumn(name="pallet_id", referencedColumnName="id")
     */
    private $pallet;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="masters")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;

    public function __construct(){
        $this->imeis = new ArrayCollection();
        $this->log_items = new ArrayCollection();
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
     * @return Master
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
     * @return Master
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
     * Set pallet
     *
     * @param integer $pallet
     *
     * @return Master
     */
    public function setPallet($pallet)
    {
        $this->pallet = $pallet;

        return $this;
    }

    /**
     * Get pallet
     *
     * @return int
     */
    public function getPallet()
    {
        return $this->pallet;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Master
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
     * @return Master
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
}

