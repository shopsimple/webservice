<?php

namespace Bajor\WebServiceBundle\Controller;

use Bajor\WebServiceBundle\Entity\QuadraticEquation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Soap;

class DefaultController extends Controller
{
    
    
    public function indexAction()
    {
        $quadraticEquation = new QuadraticEquation();

        $form = $this->createFormBuilder($quadraticEquation)
            ->setAction($this->generateUrl('bajor_form_resolved'))
            ->setMethod('POST')
            ->add('factor_a', 'number', array('label'  => 'Współczynnik A'))
            ->add('factor_b', 'number', array('label'  => 'Współczynnik B'))
            ->add('factor_c', 'number', array('label'  => 'Współczynnik C'))
            ->add('min_x', 'number', array('label'  => 'Minimum X'))
            ->add('max_x', 'number', array('label'  => 'Maximum X'))
            ->add('resolve', 'submit', array('label' => 'Rozwiąż'))
            ->getForm();

        //$form->handleRequest($request);

        //if ($form->isValid()) {
            // perform some action, such as saving the task to the database
    
        //    return $this->redirectToRoute('form_success');
        //}


        return $this->render('BajorWebServiceBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function resolvedAction()
    {
        
        $client = new \SoapClient("http://ws1.ppiatek.linuxpl.eu/app_dev.php/api/soap/check?wsdl");
        $response = $client->check('Przemek');
        var_dump($response);
        
        return $this->render('BajorWebServiceBundle:Default:resolved.html.twig', array('name' => $name));
    }
}
