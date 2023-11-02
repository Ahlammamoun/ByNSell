<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Veste;
use App\Form\VesteType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VesteRepository;
use Symfony\Component\Form\FormTypeInterface;



class VesteController extends AbstractController
{
    /**
     * @Route("/", name="vestes")
     */
    public function index(vesteRepository $vesteRepo): Response
    {

        $vestes = $vesteRepo->findAll();

        return $this->render('veste/index.html.twig', [
            'vestes' => $vestes,
        ]);
    }
  /**
     * @Route("/veste/{id}", name="veste",  requirements={"id": "\d+"})
     */
    public function show(int $id,vesteRepository $vesteRepo): Response
    {

        $veste = $vesteRepo->find($id);
        //dd($veste);
        return $this->render('veste/show.html.twig', [
            'veste' => $veste,
        ]);
    }
    //$lastReviews = $reviewRepo->findBy(['reviews' => $circuit], ['id' => 'DESC'], 1);





 /**
     * @Route("/create", name="app_veste_create", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $doctrine)
    {
        $veste = new veste();
        $formulaire = $this->createForm(VesteType::class, $veste);

        $formulaire->handleRequest($request);

        if($formulaire->isSubmitted() && $formulaire->isValid()){
            //dd($veste);
            $doctrine->persist($veste);
            $doctrine->flush();
            return $this->redirectToRoute("vestes");
        }
        return $this->renderForm('veste/create.html.twig', [
            'form' => $formulaire,
        ]);
    }














}
