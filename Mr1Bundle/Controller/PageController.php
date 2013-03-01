<?php

namespace mr1\Mr1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('mr1Mr1Bundle:Page:index.html.twig', array('name' => $name));
    }
    
    public function TimeLineAction()
    {
        
        $days = $this->container->getParameter('days');
        $assignments = $this->container->getParameter('assignments');
        $types = $this->container->getParameter('types');

     /*   foreach($days as $day)
        {
            foreach ($day['tasks'] as $task )
            {
                $assignments[$task['type']]['display']=true;
            }
        }
     */
        return $this->render('mr1Mr1Bundle:Page:TimeLine.html.twig', 
                            array('days' => $days, 'assignments'=>$assignments, 'types' => $types));
    }
    
    public function NewTimeLineAction()
    {
        
        $days = $this->container->getParameter('days2');
        $assignments = $this->container->getParameter('assignments2');
        $types = $this->container->getParameter('types2');

        return $this->render('mr1Mr1Bundle:Page:NewTimeLine.html.twig', 
                            array('days' => $days, 'assignments'=>$assignments, 'types' => $types));
    }
    
    public function ajaxAction()
    {
        $request = $this->getRequest();
        $file = $request->request->get('file');
        $result = substr($file, 0, 5);
        if($result == 'pavel')
        {
            $days = $this->container->getParameter('days2');
        }
        else 
        {
           $days = $this->container->getParameter('days'); 
        }
       
        foreach ($days as $day)
        {
            foreach ($day as $key => $task)
            {
                if($key=='tasks')
                {
                    foreach ($task as $name => $value)
                    {
                        if(isset($value['info']) && $value['info']==$file)
                        {
                            
                            $params = array('include'=>$file);
                            if ( isset($value['attachments']) )
                            {
                                $params['image'] = $value['attachments'];
                            }
                           
                            return $this->render('mr1Mr1Bundle:Page:modal.html.twig', $params );
                        }
                       
                    }
                    
                }
                elseif ($key=='name') 
                {
                    continue;
                }
            }
            
        }
    }

    public function downloadAction($filename)
    {
        $path = $this->get('kernel')->getRootDir(). '/../web/bundles/mr1mr1/attachments/';
        
        $content = file_get_contents($path.$filename);
        
        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

        $response->setContent($content);
        return $response;
    }
}
