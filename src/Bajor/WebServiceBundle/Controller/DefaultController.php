<?php

namespace Bajor\WebServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Soap;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        
        $client = new \SoapClient("http://www.webservice.dev:8991/app_dev.php/api/soap/check?wsdl");
        $response = $client->check('Przemek');
        var_dump($response);
        
        return $this->render('BajorWebServiceBundle:Default:index.html.twig', array('name' => $name));
    }
}
