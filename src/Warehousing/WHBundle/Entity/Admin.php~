<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\AdminRepository")
 */
class Admin
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
      *@ORM\ManyToMany(targetEntity="Warehouse", inversedBy="admins")
     * @ORM\JoinTable(name="warehouse_admin",
     *      joinColumns={@ORM\JoinColumn(name="warehouse_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="admin_id", referencedColumnName="id")}
     *      )
     */
    private $warehouses;

    public function __construct(){
        $this->warehouses = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Admin
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set warehouses
     *
     * @param integer $warehouses
     *
     * @return Admin
     */
    public function setWarehouses($warehouses)
    {
        $this->warehouses = $warehouses;

        return $this;
    }

    /**
     * Get warehouses
     *
     * @return int
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }

    /**
     * Add warehouse
     *
     * @param \Warehousing\WHBundle\Entity\Warehouse $warehouse
     *
     * @return Admin
     */
    public function addWarehouse(\Warehousing\WHBundle\Entity\Warehouse $warehouse)
    {
        $this->warehouses[] = $warehouse;

        return $this;
    }

    /**
     * Remove warehouse
     *
     * @param \Warehousing\WHBundle\Entity\Warehouse $warehouse
     */
    public function removeWarehouse(\Warehousing\WHBundle\Entity\Warehouse $warehouse)
    {
        $this->warehouses->removeElement($warehouse);
    }
}
