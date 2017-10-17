<?php

namespace Subbotin\BackendBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\Serializer\Serializer;
use Subbotin\BackendBundle\Entity\Currency;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class CurrencyController
 *
 * @Route("/api/currency")
 * @package Subbotin\BackendBundle\Controller
 */
class CurrencyController extends FOSRestController
{
    /**
     * Получить список и информацию по нужным нам валютам
     * и сохраним информацию в базу
     *
     * @Route(path="/all/get", name="backend_api_currency_all_get")
     * @View(serializerGroups={"currency_details"})
     *
     * @return array
     */
    public function getCurrencyAllAction()
    {
        $currencies = $this->getDoctrine()->getRepository(Currency::class)->findAll();
        $handler = $this->get('subbotin.backend_bundle.handler.currency_handler');

        return $handler->getCurrencyInfo($currencies);
    }
}