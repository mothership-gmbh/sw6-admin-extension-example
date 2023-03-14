<?php declare(strict_types=1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/iframe", name="app.iframe", methods={"GET"})
     */
    public function iframe(): Response
    {
        return $this->render('index.html.twig');
    }
}