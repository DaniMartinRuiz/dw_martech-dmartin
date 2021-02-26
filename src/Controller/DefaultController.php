<?php

namespace App\Controller;

use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $productos= $this->getDoctrine()
        ->getRepository(Productos::class)
        ->findAllActive();

      return $this->render('default/index.html.twig', array(
        'productos' => $productos,
      ));
    }
}
