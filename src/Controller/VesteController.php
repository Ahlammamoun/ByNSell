<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Veste;
use App\Repository\VesteRepository;




class VesteController extends AbstractController
{
    /**
     * @Route("/veste", name="app_veste")
     */
    public function index(vesteRepository $vesteRepo): Response
    {

        $vestes = $vesteRepo->findAll();

        return $this->render('veste/index.html.twig', [
            'vestes' => $vestes,
        ]);
    }
}
