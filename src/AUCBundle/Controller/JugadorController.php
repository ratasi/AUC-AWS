<?php

namespace AUCBundle\Controller;

use AUCBundle\Entity\Jugador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Jugador controller.
 *
 */
class JugadorController extends Controller
{
    /**
     * Lists all jugador entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jugadores = $em->getRepository('AUCBundle:Jugador')->findAll();

        return $this->render('jugador/index.html.twig', array(
            'jugadores' => $jugadores,
        ));
    }

    /**
     * Creates a new jugador entity.
     *
     */
    public function newAction(Request $request)
    {
        $jugador = new Jugador();
        $form = $this->createForm('AUCBundle\Form\JugadorType', $jugador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jugador);
            $em->flush($jugador);

            return $this->redirectToRoute('jugador_index', array('id' => $jugador->getId()));
        }

        return $this->render('jugador/new.html.twig', array(
            'jugador' => $jugador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jugador entity.
     *
     */
    public function showAction(Jugador $jugador)
    {
        $deleteForm = $this->createDeleteForm($jugador);

        return $this->render('jugador/show.html.twig', array(
            'jugador' => $jugador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jugador entity.
     *
     */
    public function editAction(Request $request, Jugador $jugador)
    {
        $deleteForm = $this->createDeleteForm($jugador);
        $editForm = $this->createForm('AUCBundle\Form\JugadorType', $jugador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jugador_edit', array('id' => $jugador->getId()));
        }

        return $this->render('jugador/edit.html.twig', array(
            'jugador' => $jugador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jugador entity.
     *
     */
    public function deleteAction(Request $request, Jugador $jugador)
    {
        $form = $this->createDeleteForm($jugador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jugador);
            $em->flush($jugador);
        }

        return $this->redirectToRoute('jugador_index');
    }

    /**
     * Creates a form to delete a jugador entity.
     *
     * @param Jugador $jugador The jugador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jugador $jugador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jugador_delete', array('id' => $jugador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
