<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogDesc
 *
 * @ORM\Table(name="log_desc")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\LogDescRepository")
 */
class LogDesc
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
    * @ORM\ManyToOne(targetEntity="Log", inversedBy="log_items")
     * @ORM\JoinColumn(name="log_id", referencedColumnName="id") 
     */
    private $log;

    /**
    * @ORM\ManyToOne(targetEntity="Master", inversedBy="log_items")
     * @ORM\JoinColumn(name="master_id", referencedColumnName="id") 
     */
    private $master;

    /**
    * @ORM\ManyToOne(targetEntity="Pallet", inversedBy="log_items")
     * @ORM\JoinColumn(name="pallet_id", referencedColumnName="id") 
     */
    private $pallet;

    /**
     * @ORM\ManyToOne(targetEntity="Imei", inversedBy="log_items")
     * @ORM\JoinColumn(name="imei_id", referencedColumnName="id") 
     */
    private $imei;


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
     * Set log
     *
     * @param integer $log
     *
     * @return LogDesc
     */
    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get log
     *
     * @return int
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set master
     *
     * @param integer $master
     *
     * @return LogDesc
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
     * Set pallet
     *
     * @param integer $pallet
     *
     * @return LogDesc
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
     * Set imei
     *
     * @param integer $imei
     *
     * @return LogDesc
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return int
     */
    public function getImei()
    {
        return $this->imei;
    }
}

