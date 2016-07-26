<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\StatusRepository")
 */
class Status
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
     * @ORM\Column(name="label", type="string", length=200)
     */
    private $label;

    /**
    *  @ORM\OneToMany(targetEntity="Pallet", mappedBy="status") 
    */
    private $pallets;

    /**
    *  @ORM\OneToMany(targetEntity="Master", mappedBy="status") 
    */
    private $masters;

    /**
    *  @ORM\OneToMany(targetEntity="Imei", mappedBy="status") 
    */
    private $imeis;

    public function __construct(){
        $this->pallets = new ArrayCollection();
        $this->masters = new ArrayCollection();
        $this->imeis = new ArrayCollection();
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
     * Set label
     *
     * @param string $label
     *
     * @return Status
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

    /**
     * Add pallet
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $pallet
     *
     * @return Status
     */
    public function addPallet(\Warehousing\WHBundle\Entity\Pallet $pallet)
    {
        $this->pallets[] = $pallet;

        return $this;
    }

    /**
     * Remove pallet
     *
     * @param \Warehousing\WHBundle\Entity\Pallet $pallet
     */
    public function removePallet(\Warehousing\WHBundle\Entity\Pallet $pallet)
    {
        $this->pallets->removeElement($pallet);
    }

    /**
     * Get pallets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPallets()
    {
        return $this->pallets;
    }

    /**
     * Add master
     *
     * @param \Warehousing\WHBundle\Entity\Master $master
     *
     * @return Status
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
     * Add imei
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imei
     *
     * @return Status
     */
    public function addImei(\Warehousing\WHBundle\Entity\Imei $imei)
    {
        $this->imeis[] = $imei;

        return $this;
    }

    /**
     * Remove imei
     *
     * @param \Warehousing\WHBundle\Entity\Imei $imei
     */
    public function removeImei(\Warehousing\WHBundle\Entity\Imei $imei)
    {
        $this->imeis->removeElement($imei);
    }

    /**
     * Get imeis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImeis()
    {
        return $this->imeis;
    }
}
