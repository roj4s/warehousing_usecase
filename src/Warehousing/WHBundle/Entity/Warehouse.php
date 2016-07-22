<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    private $maters_current;

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

}

