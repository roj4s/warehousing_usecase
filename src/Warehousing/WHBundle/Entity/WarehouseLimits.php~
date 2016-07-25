<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * WarehouseLimits
 *
 * @ORM\Table(name="warehouse_limits")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\WarehouseLimitsRepository")
 */
class WarehouseLimits
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
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="warehouses_limit_origin")
     * @ORM\JoinColumn(name="warehouse_origin_id", referencedColumnName="id")
     */
    private $warehouseOrigin;

    /**
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="warehouses_limit_target")
     * @ORM\JoinColumn(name="warehouse_target_id", referencedColumnName="id")
     */
    private $warehouseTarget;

    /**
     * @var string
     *
     * @ORM\Column(name="wh_limit", type="decimal", precision=10, scale=3)
     */
    private $whLimit;


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
     * Set warehouseOrigin
     *
     * @param integer $warehouseOrigin
     *
     * @return WarehouseLimits
     */
    public function setWarehouseOrigin($warehouseOrigin)
    {
        $this->warehouseOrigin = $warehouseOrigin;

        return $this;
    }

    /**
     * Get warehouseOrigin
     *
     * @return int
     */
    public function getWarehouseOrigin()
    {
        return $this->warehouseOrigin;
    }

    /**
     * Set warehouseTarget
     *
     * @param integer $warehouseTarget
     *
     * @return WarehouseLimits
     */
    public function setWarehouseTarget($warehouseTarget)
    {
        $this->warehouseTarget = $warehouseTarget;

        return $this;
    }

    /**
     * Get warehouseTarget
     *
     * @return int
     */
    public function getWarehouseTarget()
    {
        return $this->warehouseTarget;
    }

    /**
     * Set whLimit
     *
     * @param string $whLimit
     *
     * @return WarehouseLimits
     */
    public function setWhLimit($whLimit)
    {
        $this->whLimit = $whLimit;

        return $this;
    }

    /**
     * Get whLimit
     *
     * @return string
     */
    public function getWhLimit()
    {
        return $this->whLimit;
    }
}
