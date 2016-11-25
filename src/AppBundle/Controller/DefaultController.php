<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
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
        $book->setIssueDate(new \Datetime());
        $book->setCreatedAt(new \Datetime());
        $book->setUpdatedAt(new \Datetime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return new Response('Identifiant du livre ajouté : '. $book->getId());

 }
    public function createUserAction() {
        $user = new User();
        $user->setEmail('morganegilin@msn.com');
        $user->setPassword('blabla');
        $user->setLastname('Gilin');
        $user->setFirstname(133);
        $user->setAddress('inconnu');
        $user->setZipCode('33140');
        $user->setBirthDate(new \Datetime(1991-27-8));
        $user->setCreatedAt(new \Datetime());
        $user->setUpdatedAt(new \Datetime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $validator = $this->get('validator');
        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return $this->render('AppBundle:User:validate.html.twig',
                array(
                    'errors' => $errors,
                ));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Identifiant du lecteur ajouté : '.$user->getId());
 }


    public function showAction($id) {
        $bookRepository = $this->getDoctrine()->getRepository('AppBundle:Book');
        $book = $bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Aucun livre ne correspond à l\'id '. $id);
        }

         $user =  $book->getUser();

        if (!$user) {
            $loanStatus = 'disponible';
        } else {
            $loanStatus = 'emprunté par ' . $user->getFirstname() . 'le ' . $book->getIssueDate()->format('d M. Y');
        }

        return $this->render('AppBundle:Show:show.html.twig', array(
            'bookTitle' => $book->getTitle(),
            'loanStatus' => $loanStatus));

 }



    public function loanAction($userId,$bookId) {
        $bookRepository = $this->getDoctrine()->getRepository('AppBundle:Book');
        $book = $bookRepository->find($bookId);
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($userId);

        $book ->setUser($user);
        $this->getDoctrine()->flush();
        return $this->render('AppBundle:Show:show.html.twig', array(
            'bookTitle' => $book->getTitle(),
            'userName' => $user->getFirstName(),
            'bookDate' => $book->getIssueDate()->format('d-m-Y'),
    ));


    }


    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AppBundle:Book')->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Aucun livre ne correspond à l\'id '.$id);
        }

        $book->setSummary('Attention ! Ouvrir un roman de Dantec c\'est comme entrer en religion...');
        $em->flush();

        return new Response('Livre modifié : ' . $book->getTitle());
    }

    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AppBundle:Book')->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Aucun livre ne correspond à l\'id '.$id);
        }

        $em->remove($book);
        $em->flush();

        return new Response('Livre supprimé ');
    }



}
