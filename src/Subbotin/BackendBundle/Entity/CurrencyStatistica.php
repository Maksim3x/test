<?php

namespace Subbotin\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * CurrencyStatistica
 *
 * @ORM\Table(name="currency_statistica")
 * @ORM\Entity(repositoryClass="Subbotin\BackendBundle\Repository\CurrencyStatisticaRepository")
 */
class CurrencyStatistica
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
     * Средняя цена
     *
     * @var double $avgPrice
     *
     * @ORM\Column(type="float", scale=8, nullable=false)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_statistica__details", "currency_statistica_list", "currency_statistica_embed", "currency_statistica_dump"})
     *
     */
    protected $avgPrice = 0;

    /**
     * Изменения за 24 часа в процентах
     *
     * @var double $сhangeTwentyFour
     *
     * @ORM\Column(type="float", scale=2, nullable=false)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_statistica__details", "currency_statistica_list", "currency_statistica_embed", "currency_statistica_dump"})
     *
     */
    protected $сhangeTwentyFour = 0;

    /**
     * Валюта
     *
     * @var Currency $currency
     *
     * @ORM\ManyToOne(targetEntity="Subbotin\BackendBundle\Entity\Currency", inversedBy="statistics")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_statistica__details", "currency_statistica_list", "currency_statistica_embed", "currency_statistica_dump"})
     */
    private $currency;

    /**
     * Сайт с которого взята статистика
     *
     * @var string $site
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Serializer\Expose
     * @Serializer\Groups({"currency_statistica__details", "currency_statistica_list", "currency_statistica_embed", "currency_statistica_dump"})
     *
     */
    private $site;

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
     * Set avgPrice
     *
     * @param double $avgPrice
     *
     * @return CurrencyStatistica
     */
    public function setAvgPrice($avgPrice)
    {
        $this->avgPrice = $avgPrice;

        return $this;
    }

    /**
     * Get avgPrice
     *
     * @return double
     */
    public function getAvgPrice()
    {
        return $this->avgPrice;
    }

    /**
     * Set сhangeTwentyFour
     *
     * @param double $сhangeTwentyFour
     *
     * @return CurrencyStatistica
     */
    public function setсhangeTwentyFour($сhangeTwentyFour)
    {
        $this->сhangeTwentyFour = $сhangeTwentyFour;

        return $this;
    }

    /**
     * Get сhangeTwentyFour
     *
     * @return double
     */
    public function getсhangeTwentyFour()
    {
        return $this->сhangeTwentyFour;
    }

    /**
     * Set currency
     *
     * @param \Subbotin\BackendBundle\Entity\Currency $currency
     *
     * @return CurrencyStatistica
     */
    public function setCurrency(\Subbotin\BackendBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Subbotin\BackendBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return CurrencyStatistica
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }
}
