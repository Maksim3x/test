<?php

namespace Subbotin\BackendBundle\Handler\Statistics;

use Subbotin\BackendBundle\Entity\Currency;

class CoinMarketCapCurrencyStatistics extends ACurrencyStatistics
{
    public function __construct()
    {
        parent::__construct();

        $this->getStatistics();
    }

    public function getStatistics()
    {
        $html = $this->getContentByUrl('https://coinmarketcap.com/coins/');

        $result = [];

        $patternName = '/<a class="currency-name-display" href="[a-zA-Z0-9-_.\s\/]{1,100}">([a-zA-Z0-9-_.\s]{1,100})<\/a>/';
        preg_match_all($patternName, $html, $matches, PREG_OFFSET_CAPTURE);

        $result[] = array_map(function($element){return $element[0];}, $matches[1]);

        $patternName = '/<a href="[^.]{1,100}" class="price" data-usd="[0-9.e-]{1,100}" data-btc="[0-9.e-]{1,100}"\s{0,1}>([0-9.$]{1,100})<\/a>/';
        preg_match_all($patternName, $html, $matches, PREG_OFFSET_CAPTURE);

        $result[] = array_map(function($element){return doubleval(substr($element[0], 1));}, $matches[1]);

        $patternName = '/<td class="no-wrap percent-24h\s{0,2}[^.]{1,100}\s{0,2}text-right" data-usd="[0-9.e-]{1,100}" data-btc="[0-9.e-]{1,100}"\s{0,1}>([0-9.%-]{1,100})<\/td>/';
        preg_match_all($patternName, $html, $matches, PREG_OFFSET_CAPTURE);

        $result[] = array_map(function($element){return doubleval(substr($element[0], 0, strlen($element[0])-1));}, $matches[1]);

        $this->data = $result;
    }

    public function findCurrency(Currency $currency)
    {
        for($i = 0; $i < count($this->data[0]); $i++)
        {
            if(strtolower($this->data[0][$i]) === strtolower($currency->getCode()))
            {
                if(count($this->data[1]) > $i && count($this->data[2]) > $i)
                {
                    return [$this->data[1][$i],$this->data[2][$i]];
                }
            }
        }

        return null;
    }
}