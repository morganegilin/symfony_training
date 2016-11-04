<?php

namespace HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($name,$sex)
    {
        return $this->render('HelloBundle:Hello:index.html.twig',array('name'=>$name,'sex'=>$sex));
    }
}
