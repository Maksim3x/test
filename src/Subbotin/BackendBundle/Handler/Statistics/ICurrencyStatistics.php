<?php

namespace Subbotin\BackendBundle\Handler\Statistics;

use Subbotin\BackendBundle\Entity\Currency;

interface ICurrencyStatistics
{
    public function getStatistics();

    public function findCurrency(Currency $currency);

    public function isNull();
}