<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DefaultController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return new Response($this->twig->render('homepage.html.twig'));
    }

    /**
     * @Route("/map", name="map")
     */
    public function map()
    {
        return new Response($this->twig->render('map.html.twig'));
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail()
    {
        return new Response($this->twig->render('detail.html.twig'));
    }
}
