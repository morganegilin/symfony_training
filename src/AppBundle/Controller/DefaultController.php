<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Book;

class DefaultController extends Controller
{
    public function indexAction($name,$sex)
    {
        switch ($sex) {
            case "h":
                $type="monsieur";
                break;
            case "f":
                $type="madame";
                break;
            default:
                $type="inconnu";
                break;
        }
        return $this->render('HelloBundle:Hello:index.html.twig',array('name'=>$name,'type'=>$type));
    }
    /**
     * @Route("/", name="homepage")
     */
    public function helloAction($name)
    {
        return new Response('Hello '. $name . ', you are in the "hello" action (controller)');
    }

    public function createAction() {
        $book = new Book();
        $book->setIsbn('9782070752447');
        $book->setTitle('Villa vortex');
        $book->setSummary('11 septembre 2001, un nouveau monde commence...');
        $book->setPublicationYear(2003);
        $book->setCreatedAt(new \Datetime());
        $book->setUpdatedAt(new \Datetime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return new Response('Identifiant du livre ajouté : '. $book->getId());

 }

}
