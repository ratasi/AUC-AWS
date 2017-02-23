<?php // Pear Mail Library

namespace AUCBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//
// require_once('AUC/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

class MailController extends Controller
{

  public function sendAction()
 {

    $request=$this->getrequest(request $request);
    if ($request->getMethod() == "POST") {
      $nombre = $request->get('name');
      $apellidos = $request->get('apellidos');
      $email = $request->get('email');
      $asunto = $request->get('asunto');
      $mensaje = $request->get('mensaje');

      $mailer = $this->container->get('mailer');
      $transport = \Swift_SmtpTransport::newInstance('smtp@gmail.com', 465, 'ssl')
          ->setUsername('proyectounion@gmail.com')
          ->setPassword('961324786');
          $mailer = \Swift_Mailer::newInstance($transport);
          $message = \Swift_Message::newInstance('Test')
          ->setSubject($nombre)
          ->setFrom($email)
          ->setTo('proyectounion@gmail.com')
          ->setBody($message);
          $this->get('mailer')->send($message);
    }

    return $this->render('AUCBundle:Default:contacto.html.twig');

  }
}
