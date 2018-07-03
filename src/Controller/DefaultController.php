<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\City;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
    	$doc = $this->getDoctrine();

        return $this->render('default/index.html.twig', [
	        'cities' => $doc->getRepository(City::class)->findAll(),
	        'categories' => $doc->getRepository(Category::class)->findAll()
        ]);
    }
}
