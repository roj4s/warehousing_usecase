<?php

namespace Warehousing\WHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Warehousing\WHBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_name", type="string", length=100)
     */
    private $commercialName;

    /**
     * @var string
     *
     * @ORM\Column(name="unitary_price", type="decimal", precision=10, scale=3)
     */
    private $unitaryPrice;

    /**
    *  @ORM\OneToMany(targetEntity="Imei", mappedBy="product") 
    */
    private $imeis;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->imeis = new ArrayColection();
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Product
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

    /**
     * Set commercialName
     *
     * @param string $commercialName
     *
     * @return Product
     */
    public function setCommercialName($commercialName)
    {
        $this->commercialName = $commercialName;

        return $this;
    }

    /**
     * Get commercialName
     *
     * @return string
     */
    public function getCommercialName()
    {
        return $this->commercialName;
    }

    /**
     * Set unitaryPrice
     *
     * @param string $unitaryPrice
     *
     * @return Product
     */
    public function setUnitaryPrice($unitaryPrice)
    {
        $this->unitaryPrice = $unitaryPrice;

        return $this;
    }

    /**
     * Get unitaryPrice
     *
     * @return string
     */
    public function getUnitaryPrice()
    {
        return $this->unitaryPrice;
    }
}

