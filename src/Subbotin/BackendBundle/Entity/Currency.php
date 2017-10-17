<?php

namespace Subbotin\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Currency
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity(repositoryClass="Subbotin\BackendBundle\Repository\CurrencyRepository")
 * @UniqueEntity("code")
 * @Serializer\ExclusionPolicy("all")
 */
class Currency
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
     * Наименование валюты
     *
     * @var string $name
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_details", "currency_list", "currency_embed", "currency_dump"})
     *
     */
    protected $name;

    /**
     * Уникальный код валюты
     *
     * @var string $code
     *
     * @ORM\Column(type="string", unique=true, nullable=false)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_details", "currency_list", "currency_embed", "currency_dump"})
     *
     */
    protected $code;

    /**
     * История изменений курса валюты
     *
     * @var CurrencyStatistica $statistics
     *
     * @ORM\OneToMany(targetEntity="Subbotin\BackendBundle\Entity\CurrencyStatistica", mappedBy="currency")
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_details", "currency_list", "currency_embed", "currency_dump"})
     *
     */
    protected $statistics;

    /**
     * Исторические данные валюты
     *
     * @var string $history
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_details", "currency_list", "currency_embed", "currency_dump"})
     *
     */
    protected $history;

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
     * Получить строковое занчение
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Currency
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
     * Set history
     *
     * @param string $history
     *
     * @return Currency
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->statistics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Currency
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
     * Add statistic
     *
     * @param \Subbotin\BackendBundle\Entity\CurrencyStatistica $statistic
     *
     * @return Currency
     */
    public function addStatistic(\Subbotin\BackendBundle\Entity\CurrencyStatistica $statistic)
    {
        $this->statistics[] = $statistic;

        return $this;
    }

    /**
     * Remove statistic
     *
     * @param \Subbotin\BackendBundle\Entity\CurrencyStatistica $statistic
     */
    public function removeStatistic(\Subbotin\BackendBundle\Entity\CurrencyStatistica $statistic)
    {
        $this->statistics->removeElement($statistic);
    }

    /**
     * Get statistics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistics()
    {
        return $this->statistics;
    }
}
