<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;


    public function __construct()
    {
        $this->masters = new ArrayColection();
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
}

