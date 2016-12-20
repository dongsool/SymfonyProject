<?php

namespace M2I\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

  public function loginAction(Request $request)
  {
    $user = $this->getUser();

    if (null === $user) {
      // Here the user is anonymous or the URL is not behind the firewall
      return $this->redirectToRoute('m2_i_blog_homepage');
    }
    // If the Visitor is already identified, redirecting to Home
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
      return $this->redirectToRoute('m2_i_blog_homepage');
    }

    // The service authentication_utils allows to get the user name
    // and error in case the form as already been submit but was Invalid
    // (wrong password for exemple)
    $atuthenticationUtils = $this->get('security.authentication_utils');

    return $this->render('M2IUserBundle:Security:login.html.twig', array(
                         'last_username' => $atuthenticationUtils->getLastUsername(),
                         'error' => $atuthenticationUtils->getLastAuthenticationError(),
                       ));
  }
}

 ?>
