<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\LogRepository")
 */
class Log
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
      * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="logs_destiny")
     * @ORM\JoinColumn(name="warehouse_destiny_id", referencedColumnName="id")
     */
    private $warehouseDestiny;

    /**
    * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="logs_source")
     * @ORM\JoinColumn(name="warehouse_source_id", referencedColumnName="id")
     */
    private $warehouseSource;

    /**
    * @ORM\ManyToOne(targetEntity="Transporter", inversedBy="logs")
     * @ORM\JoinColumn(name="transporter_id", referencedColumnName="id")
     */
    private $transporter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


     /**
    *  @ORM\OneToMany(targetEntity="LogDesc", mappedBy="log") 
    */
    private $log_items;

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
     * Set warehouseDestiny
     *
     * @param integer $warehouseDestiny
     *
     * @return Log
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
     * Set warehouseSource
     *
     * @param integer $warehouseSource
     *
     * @return Log
     */
    public function setWarehouseSource($warehouseSource)
    {
        $this->warehouseSource = $warehouseSource;

        return $this;
    }

    /**
     * Get warehouseSource
     *
     * @return int
     */
    public function getWarehouseSource()
    {
        return $this->warehouseSource;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Log
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set transporter
     *
     * @param \Warehousing\WHBundle\Entity\Transporter $transporter
     *
     * @return Log
     */
    public function setTransporter(\Warehousing\WHBundle\Entity\Transporter $transporter = null)
    {
        $this->transporter = $transporter;

        return $this;
    }

    /**
     * Get transporter
     *
     * @return \Warehousing\WHBundle\Entity\Transporter
     */
    public function getTransporter()
    {
        return $this->transporter;
    }

    /**
     * Add logItem
     *
     * @param \Warehousing\WHBundle\Entity\LogDesc $logItem
     *
     * @return Log
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
}
