<?php

namespace Subbotin\BackendBundle\Handler\Statistics;

/**
 * Фабрика классов для парсинга информации с различных сайтов
 *
 * Class CurrencyStatisticsFactory
 * @package Subbotin\BackendBundle\Handler\Statistics
 */
class CurrencyStatisticsFactory
{
    /**
     * Фабрика для выбора сайта сбора статистики
     *
     * @param $type
     * @return null|CoinCapCurrencyStatistics|CoinMarketCapCurrencyStatistics
     */
    public function get($type)
    {
        $instance = null;

        switch ($type)
        {
            case 'coinmarketcap.com':
                $instance = new CoinMarketCapCurrencyStatistics();
                break;

            case 'coincap.io':
                $instance = new CoinCapCurrencyStatistics();
                break;
        }

        return $instance;
    }
}