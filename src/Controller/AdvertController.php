<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\City;
use App\Repository\AdvertRepository;
use App\Repository\CityRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{

	/**
	 * @var AdvertRepository
	 */
	protected $_advertRepo;

	/**
	 * @var CityRepository
	 */
	protected $_cityRepo;

    /**
     * @Route("/deals", name="deals")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deals()
    {
        return $this->_renderListing($this->_getAdvertRepo()->getAllDeals());
    }

	/**
	 * @Route("/requests", name="requests")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function requests()
	{
		return $this->_renderListing($this->_getAdvertRepo()->getAllRequests());
    }

	/**
	 * @Route("/deals/view/{id}", name="view_advert")
	 * @param Advert $advert
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function view( Advert $advert )
	{
		return $this->render('advert/view.html.twig', [
			'advert' => $advert
		]);
    }

	/**
	 * @Route("/adverts/{slug}", name="city_adverts")
	 * @param string $slug
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function advertsByCity( $slug )
	{
		/** @var City $city */
		$city = $this->_getCityRepo()->findOneBy(['slug' => $slug]);
		return $this->_renderListing(
			$city->getAdverts()
		);
    }

	/**
	 * Render any listing of adverts
	 *
	 * @param array $adverts
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function _renderListing( $adverts )
	{
		return $this->render('advert/index.html.twig', [
			'adverts' => $adverts
		]);
    }

	/**
	 * @return AdvertRepository|\Doctrine\Common\Persistence\ObjectRepository
	 */
	protected function _getAdvertRepo()
	{
		if (!$this->_advertRepo) {
			$this->_advertRepo = $this->getDoctrine()->getRepository(Advert::class);
		}
		return $this->_advertRepo;
    }

	/**
	 * @return CityRepository|\Doctrine\Common\Persistence\ObjectRepository
	 */
	protected function _getCityRepo() 
	{
		if (!$this->_cityRepo) {
			$this->_cityRepo = $this->getDoctrine()->getRepository(City::class);
		}
		return $this->_cityRepo;
    }
}
