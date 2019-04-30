<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlancdeblancController extends AbstractController
{
    /**
     * @Route("/blancdeblanc", name="blancdeblanc")
     */
    public function index()
    {
        return $this->render('blancdeblanc/index.html.twig', [
            'controller_name' => 'BlancdeblancController',
            'current_menu' => 'blancdeblanc',
        ]);
    }
}
