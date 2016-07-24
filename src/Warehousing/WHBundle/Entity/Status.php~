<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}

