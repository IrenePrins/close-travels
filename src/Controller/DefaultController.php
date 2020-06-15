<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @var MailerInterface
     */
    private $mailer;


    public function __construct(Environment $twig, FormFactoryInterface $formFactory, MailerInterface $mailer)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->mailer = $mailer;
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
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function detail(Request $request, EntityManagerInterface $entityManager)
    {
        $booking = new Booking();
        $form  = $this->formFactory->create(BookingType::class, $booking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();

            $entityManager->persist($booking);

            try {
                $entityManager->flush();
            } catch (OptimisticLockException $e) {
                throw new OptimisticLockException('error: OptimisticLockException', $booking);
            } catch (ORMException $e) {
                throw new ORMException('error: ORMException', $booking);
            }

            $this->sendMail($booking);
            return new Response($this->twig->render('confirmation.html.twig', [
                'data' => $form->getData()
            ]));
        }

        return new Response($this->twig->render('detail.html.twig', [
            'form' => $form->createView()
        ]));
    }

    public function sendMail($data) : void {

        $email = (new TemplatedEmail())
            ->from('ireneprins11@hotmail.com')
            ->to($data->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->htmlTemplate('email/default.html.twig')
            ->context([
                'startDate' => $data->getStartDate(),
                'endDate' => $data->getEndDate(),
                'transport' => $data->getTransport(),
                'activities' => $data->getActivities(),
                'housing' => $data->getHousing(),
            ]);

            $this->mailer->send($email);
    }
}
