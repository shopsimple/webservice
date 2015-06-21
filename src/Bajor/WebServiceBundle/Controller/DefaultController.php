<?php

namespace Bajor\WebServiceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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


        return $this->render('BajorWebServiceBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function resolvedAction(Request $request)
    {
        
        $errorMsg = '';
        $response = null;
        
        $quadraticEquation = new QuadraticEquation();

        $form = $this->createFormBuilder($quadraticEquation)
            ->add('factor_a', 'number', array('label'  => 'Współczynnik A'))
            ->add('factor_b', 'number', array('label'  => 'Współczynnik B'))
            ->add('factor_c', 'number', array('label'  => 'Współczynnik C'))
            ->add('min_x', 'number', array('label'  => 'Minimum X'))
            ->add('max_x', 'number', array('label'  => 'Maximum X'))
            ->getForm();
        
        $form->handleRequest($request);
        
        $a = $form->get('factor_a')->getData();
        $b = $form->get('factor_b')->getData();
        $c = $form->get('factor_c')->getData();
        $minX = $form->get('min_x')->getData();
        $maxX = $form->get('max_x')->getData();
        
        
        $wsdlUrl = "http://ws1.ppiatek.linuxpl.eu/api/equation/quadratic?wsdl";
        
        try {
        
            $client = new \SoapClient($wsdlUrl);
            $response = $client->quadratic($a, $b, $c, $minX, $maxX);
        
        } catch (\SoapFault $e) {
            $errorMsg = $e->getMessage();
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
        }
        
        return $this->render('BajorWebServiceBundle:Default:resolved.html.twig', 
            array(
                'factor_a' => $a,
                'factor_b' => $b,
                'factor_c' => $c,
                'solution' => $response,
                'error_msg' => $errorMsg
            )
        );
    }
}
