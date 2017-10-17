<?php

namespace Subbotin\BackendBundle\Handler\Statistics;

use Subbotin\BackendBundle\Entity\Currency;

abstract class ACurrencyStatistics implements ICurrencyStatistics
{
    protected $data;

    /**
     * ACurrencyStatistics constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * Парсим статистику с сайта
     */
    public function getStatistics()
    {

    }

    /**
     * Ищем валюту среди списка
     *
     * @param Currency $currency
     */
    public function findCurrency(Currency $currency)
    {

    }

    /**
     * Проверка на пустую статистику
     *
     * @return bool
     */
    public function isNull()
    {
        if(count($this->data) == 0)
        {
            return false;
        }

        return true;
    }

    public function getContentByUrl($url, $isJson = false)
    {
        $ch =  curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        if($isJson)
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        }

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}