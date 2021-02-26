<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Form\ProductosType;
use App\Repository\ProductosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{
    /**
     * @Route("/", name="productos_index", methods={"GET"})
     */
    public function index(ProductosRepository $productosRepository): Response
    {
        return $this->render('productos/index.html.twig', [
            'productos' => $productosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="productos_new", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $producto = new Productos();
        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('productos_show', ['id' => $producto->getId()]);
        }

        return $this->render('productos/new.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_show", methods={"GET"})
     */
    public function show(Request $request, $id)
    {
        $producto = $this->getDoctrine()->getManager()->getRepository(Productos::class)->find($id);
        $deleteForm = $this->createDeleteForm($producto);
        
    return $this->render('productos/show.html.twig', [
      'producto' => $producto,
      'delete_form' => $deleteForm->createView(),
    ]);
    }

  /**
   * Displays a form to edit an existing offer entity.
   * @Route("/{id}/edit", name="productos_edit", methods={"GET", "POST"} )
   */
    public function edit(Request $request, Productos $producto)
    {
        $deleteForm = $this->createDeleteForm($producto);
        
        $editform = $this->createForm(ProductosType::class, $producto);
        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productos_show', ['id' => $producto->getId()]);
        }

    return $this->render('productos/edit.html.twig', [
      'producto' => $producto,
      'edit_form' => $editform->createView(),
      'delete_form' => $deleteForm->createView(),
    ]);
    }

  /**
   * Deletes a offer entity.
   * @Route("/{id}/delete", name="productos_delete", methods={"DELETE"} )
   */
    public function delete(Request $request, Productos $producto)
    {
    $form = $this->createDeleteForm($producto);
    $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($producto);
          $em->flush();
        }
        return $this->redirectToRoute('productos_index');
    }
    
    private function createDeleteForm(Productos $producto) {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('productos_delete', ['id' => $producto->getId()]))
      ->setMethod('DELETE')
      ->getForm();
  }
}
