<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imei
 *
 * @ORM\Table(name="imei")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\ImeiRepository")
 */
class Imei
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
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="imeis_current")
     * @ORM\JoinColumn(name="warehouse_current_id", referencedColumnName="id")
     */
    private $warehouseCurrent;

    /**
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="imeis_arriving")
     * @ORM\JoinColumn(name="warehouse_destiny_id", referencedColumnName="id")
     */
    private $warehouseDestiny;

    /**
     * @ORM\ManyToOne(targetEntity="Master", inversedBy="imeis")
     * @ORM\JoinColumn(name="master_id", referencedColumnName="id") 
     */
    private $master;

        /**
    *  @ORM\OneToMany(targetEntity="LogDesc", mappedBy="imei") 
    */
    private $log_items;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="imeis")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
      * @ORM\ManyToOne(targetEntity="Status", inversedBy="imeis")
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
     * @return Imei
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
     * @return Imei
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
     * Set master
     *
     * @param integer $master
     *
     * @return Imei
     */
    public function setMaster($master)
    {
        $this->master = $master;

        return $this;
    }

    /**
     * Get master
     *
     * @return int
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * Set product
     *
     * @param integer $product
     *
     * @return Imei
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return int
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Imei
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
     * @return Imei
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

