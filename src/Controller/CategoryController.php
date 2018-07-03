<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}", name="category_view")
     */
    public function view($slug)
    {
    	/** @var Category $category */
    	$category = $this->getDoctrine()
	                     ->getRepository(Category::class)
	                     ->findOneBy(['slug' => $slug]);
        return $this->render('advert/index.html.twig', [
	        'adverts' => $category->getAdverts()
        ]);
    }
}
