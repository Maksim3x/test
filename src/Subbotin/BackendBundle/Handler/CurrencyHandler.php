<?php

namespace Subbotin\BackendBundle\Handler;

use Doctrine\Common\Collections\ArrayCollection;
use Subbotin\BackendBundle\Entity\Currency;
use Subbotin\BackendBundle\Entity\CurrencyStatistica;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Вспомогательный функционал
 *
 * Class CurrencyHandler
 * @package Subbotin\BackendBundle\Handler
 */
class CurrencyHandler
{
    const LIST_SITES = ["coinmarketcap.com", "coincap.io"];

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Получить статистику по всем валютам по нужным сайтам
     *
     * @param $currencies
     * @param array $sites
     * @return array
     */
    public function getCurrencyInfo($currencies, $sites = self::LIST_SITES)
    {
        $statistics = [];

        $manager = $this->container->get('doctrine')->getEntityManager();
        $factory = $this->container->get('subbotin.backend_bundle.service.currency_statistics_factory');

        $manager->beginTransaction();

        try
        {
            foreach ($sites as $site)
            {
                $currencyStatistics = $factory->get($site);

                foreach ($currencies as $currency)
                {
                    $info = $currencyStatistics->findCurrency($currency);

                    if($info)
                    {
                        $csModel = new CurrencyStatistica();
                        $csModel->setAvgPrice(floatval($info[0]));
                        $csModel->setсhangeTwentyFour(floatval($info[1]));
                        $csModel->setCurrency($currency);
                        $csModel->setSite($site);

                        $manager->persist($csModel);
                        $manager->flush();
                    }

                    $statistics[$currency->getName()][$site] = $info;
                }
            }

            $manager->commit();
        }
        catch (\Exception $e)
        {
            $manager->rollback();
            $statistics = [
                'error' => $e->getMessage()
            ];
        }

        return $statistics;
    }
}