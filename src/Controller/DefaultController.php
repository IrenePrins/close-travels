<?php

namespace App\Controller;

use App\Form\BookingType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DefaultController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    public function __construct(Environment $twig, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
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
        $form  = $this->formFactory->create(BookingType::class);

        return new Response($this->twig->render('detail.html.twig', [
            'form' => $form->createView()
        ]));
    }
}
