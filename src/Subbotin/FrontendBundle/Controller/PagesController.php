<?php

namespace Subbotin\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PagesController
 * @package Subbotin\FrontendBundle\Controller
 */
class PagesController extends Controller
{
    /**
     * начальная страница
     *
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        return $this->render('SubbotinFrontendBundle:Pages:index.html.twig');
    }
}
