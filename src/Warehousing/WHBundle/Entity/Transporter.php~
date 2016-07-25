<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Transporter
 *
 * @ORM\Table(name="transporter")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\TransporterRepository")
 */
class Transporter
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
     * @ORM\Column(name="label", type="string", length=50, unique=true)
     */
    private $label;

     /**
    *  @ORM\OneToMany(targetEntity="Log", mappedBy="transporter") 
    */
    private $logs;

    public function __construct(){
        $this->logs = new ArrayCollection();        
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
     * @return Transporter
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
     * Add log
     *
     * @param \Warehousing\WHBundle\Entity\Log $log
     *
     * @return Transporter
     */
    public function addLog(\Warehousing\WHBundle\Entity\Log $log)
    {
        $this->logs[] = $log;

        return $this;
    }

    /**
     * Remove log
     *
     * @param \Warehousing\WHBundle\Entity\Log $log
     */
    public function removeLog(\Warehousing\WHBundle\Entity\Log $log)
    {
        $this->logs->removeElement($log);
    }

    /**
     * Get logs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogs()
    {
        return $this->logs;
    }
}
