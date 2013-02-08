<?php

namespace mr1\Mr1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('mr1Mr1Bundle:Page:index.html.twig', array('name' => $name));
    }
    
    public function TimeLineAction()
    {
        $days = $this->container->getParameter('days');
        return $this->render('mr1Mr1Bundle:Page:TimeLine.html.twig', array('days' => $days));
    }
}
