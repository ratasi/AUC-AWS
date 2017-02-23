<?php

namespace AUCBundle\Controller;

use AUCBundle\Entity\Noticia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Noticium controller.
 *
 */
class NoticiaController extends Controller
{
    /**
     * Lists all noticium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $noticias = $em->getRepository('AUCBundle:Noticia')->findAll();

        return $this->render('noticia/index.html.twig', array(
            'noticias' => $noticias,
        ));
    }

    /**
     * Creates a new noticium entity.
     *
     */
    public function newAction(Request $request)
    {
        $noticia = new Noticia();
        $form = $this->createForm('AUCBundle\Form\NoticiaType', $noticia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush($noticia);

            return $this->redirectToRoute('noticia_index', array('id' => $noticia->getId()));
        }

        return $this->render('noticia/new.html.twig', array(
            'noticium' => $noticia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a noticium entity.
     *
     */
    public function showAction(Noticia $noticia)
    {
        $deleteForm = $this->createDeleteForm($noticia);

        return $this->render('noticia/show.html.twig', array(
            'noticia' => $noticia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing noticium entity.
     *
     */
    public function editAction(Request $request, Noticia $noticia)
    {
        $deleteForm = $this->createDeleteForm($noticia);
        $editForm = $this->createForm('AUCBundle\Form\NoticiaType', $noticia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('noticia_edit', array('id' => $noticia->getId()));
        }

        return $this->render('noticia/edit.html.twig', array(
            'noticium' => $noticia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a noticium entity.
     *
     */
    public function deleteAction(Request $request, Noticia $noticia)
    {
        $form = $this->createDeleteForm($noticia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($noticia);
            $em->flush($noticia);
        }

        return $this->redirectToRoute('noticia_index');
    }

    /**
     * Creates a form to delete a noticium entity.
     *
     * @param Noticia $noticia The noticium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Noticia $noticia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('noticia_delete', array('id' => $noticia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function allAction()
    {
        $repository = $this->getDoctrine()->getRepository('AUCBundle:Noticia');
        $noticias = $repository->findAll();
        return $this->render('AUCBundle:Default:index.html.twig', array("noticias"=>$noticias));
    }

    public function noticiaAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AUCBundle:Noticia');
        $noticias = $repository->findOneById($id);

        return $this->render('AUCBundle:Default:noticia.html.twig', array("noticias"=> $noticias));
    }

    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$noticias = $em->getRepository('AUCBundle:Noticia')->findAll();
        $dql= 'SELECT n FROM AUCBundle:Noticia n ORDER BY n.id DESC';
        $query= $em->createQuery($dql);

        /**
        *@ var $paginator \Knp\Component\Pager\Paginator
        */

        $paginator  = $this->get('knp_paginator');
        $noticias = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );

        // parameters to template
        return $this->render('AUCBundle:Default:index.html.twig', array('noticias' => $noticias));
    }
}
