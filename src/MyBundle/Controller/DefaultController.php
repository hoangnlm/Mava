<?php

namespace MyBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MyBundle:Default:index.html.twig');
    }

    /**
     * @Route("/about/{name}", name="aboutpage", defaults={"name":null})
     */
    public function aboutAction($name)
    {
        if (!$name) {
            throw $this->createNotFoundException('Name is null!');
        }

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy(array('name' => $name));
        if (false === $user instanceof User) {
            throw $this->createNotFoundException(
                'No user named ' . $name . ' found!'
            );
        }

        return $this->render('MyBundle:About:index.html.twig', array('user' =>
            $user));
    }
}
