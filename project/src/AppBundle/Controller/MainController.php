<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 14.11.16
 * Time: 00:26
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
 
 }