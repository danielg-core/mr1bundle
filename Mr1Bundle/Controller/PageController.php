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
    
    public function ajaxAction()
    {
        $request = $this->getRequest();
        $file = $request->request->get('file');
        $days = $this->container->getParameter('days');
        foreach ($days as $day)
        {
            foreach ($day as $key => $task)
            {
                if($key=='tasks')
                {
                    foreach ($task as $name => $value)
                    {
                        //if(isset($value['attachments']) && $value['info']==$file)
                        if(isset($value['attachments']) && $value['info']==$file)
                        {
                           // return $this->render('mr1Mr1Bundle:Page:'.$file, array('image'=>$value['attachments']));
                        
                            return $this->render('mr1Mr1Bundle:Page:modal.html.twig', array('image'=>$value['attachments'],
                                                                                            'include'=>$file));
                        }
                    }
                    return $this->render('mr1Mr1Bundle:Page:'.$file);
                }
            }
        }
    }

    public function downloadAction($filename)
    {
        $path = $this->get('kernel')->getRootDir(). "/../web/bundles/mr1mr1/attachments/";
        $content = file_get_contents($path.$filename);

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

        $response->setContent($content);
        return $response;
    }
}
