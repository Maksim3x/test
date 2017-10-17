<?php

namespace Subbotin\BackendBundle\Handler\Statistics;

use Subbotin\BackendBundle\Entity\Currency;

class CoinCapCurrencyStatistics extends ACurrencyStatistics
{
    public function __construct()
    {
        parent::__construct();

        $this->getStatistics();
    }

    public function getStatistics()
    {
        $this->data = json_decode($this->getContentByUrl('http://coincap.io/front'));
    }

    public function findCurrency(Currency $currency)
    {
        foreach ($this->data as $currencyItem)
        {
            if(strtolower($currencyItem->long) === strtolower($currency->getCode()))
            {
                return [$currencyItem->price, $currencyItem->cap24hrChange];
            }
        }

        return null;
    }
}