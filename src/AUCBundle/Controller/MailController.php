<?php // Pear Mail Library

namespace AUCBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AUCBundle\Form\ContactType;


class MailController extends Controller
{

  public function contactAction(Request $query)
      {
          $form = $this->createForm(ContactType::class);

          if ($query->isMethod('POST')) {
              $form->handleRequest($query);

              if ($form->isValid()) {
                  $mailer = $this->get('mailer');
                  $message = $mailer->createMessage()
                      ->setSubject($form->get('asunto')->getData())
                      ->setFrom($form->get('email')->getData())
                      ->setTo('unioncatarroja@gmail.com')
                      ->setBody(
                          $this->renderView(
                              'AUCBundle:Default:exito.html.twig',
                              array(
                                  'ip' => $query->getClientIp(),
                                  'nombre' => $form->get('nombre')->getData(),
                                  'apellidos' => $form->get('apellidos')->getData(),
                                  'email' => $form->get('email')->getData(),
                                  'asunto' => $form->get('asunto')->getData(),
                                  // 'email' => $form->get('email')->getData(),
                                  'mensaje' => $form->get('mensaje')->getData()
                              )
                          )
                      );

                  $mailer->send($message);

                  $query->getSession()->getFlashBag()->add('success', 'Tu mensaje ha sido enviado. Gracias');

                  return $this->redirect($this->generateUrl('auc_contacto'));
              }
          }

          return $this->render('AUCBundle:Default:contacto.html.twig', array(
              'form'   => $form->createView()
          ));
      }
    }
