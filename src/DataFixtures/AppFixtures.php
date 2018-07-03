<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\Category;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Utils\Slugger;

class AppFixtures extends Fixture
{

	//region Properties

	/**
	 * @var array
	 */
	private $cities = [
		"Alsace",
		"Aquitaine",
		"Auvergne",
		"Basse-Normandie",
		"Bourgogne",
		"Bretagne",
		"Centre",
		"Champagne-Ardenne",
		"Corse",
		"Franche-Comté",
		"Haute-Normandie",
		"Ile-de-France",
		"Languedoc-Roussillon",
		"Limousin",
		"Lorraine",
		"Midi-Pyrénées",
		"Nord-Pas-de-Calais",
		"Pays de la Loire",
		"Picardie",
		"Poitou-Charentes",
		"Provence-Alpes-Côte d'Azur",
		"Rhône-Alpes",
		"Guadeloupe",
		"Martinique",
		"Guyane",
		"Réunion"
	];

	/**
	 * @var array
	 */
	private $categories = [
		"Jobs",
		"Vehicles",
		"Utilities",
		"Boating",
		"Music Equipment",
		"Furnishing",
		"Home Appliance",
		"Housing",
		"Clothing",
		"Animals",
		"Games & Toys",
		"Office Supplies",
		"Medical Material",
		"Services",
		"Events",
		"Private lessons",
		"Other",
	];

	/**
	 * @var Slugger
	 */
	protected $_slugger;

	/**
	 * @var ObjectManager
	 */
	protected $_manager;

	//endregion

	/**
	 * AppFixtures constructor.
	 *
	 * @param Slugger $slugger
	 */
	public function __construct(Slugger $slugger)
	{
		$this->_slugger = $slugger;
	}

	/**
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
    {
    	// persist for other functions to access to reduce code duplication
    	$this->_manager = $manager;

        // Create initial Cities
	    foreach ( $this->cities as $cityName ) {
		    $city = new City();
		    $this->_setNameAndSlug($city, $cityName);
		    $manager->persist($city);
	    }

	    // Create initial Categories
	    foreach ( $this->categories as $categoryName ) {
		    $category = new Category();
		    $this->_setNameAndSlug($category, $categoryName);
		    $manager->persist($category);
	    }

	    // Save our progress as we will query these next
	    $manager->flush();

	    // Create initial Adverts (10 of each type)
	    for($i = 1; $i <= 10; $i++) {
	    	$request = new Advert();
	    	$request->setType('request');
	    	$request->setTitle('Request ' . $i);
	    	$this->_buildAdvert($request);
	    	$manager->persist($request);
	    }
	    for ($i = 1; $i <= 10; $i++) {
	    	$deal = new Advert();
	    	$deal->setType('deal');
	    	$deal->setTitle('Deal ' . $i);
	    	$deal->setPrice(mt_rand(10, 1000));
	    	$this->_buildAdvert($deal);
	    	$manager->persist($deal);
	    }

        $manager->flush();
    }

	/**
	 * Set the name and slug of an entity.
	 * Reduce duplication of code... even though it's only 2 lines.
	 *
	 * @param Category|City|object $object
	 * @param string $name
	 */
	protected function _setNameAndSlug( &$object, $name )
	{
		$object->setName($name);
		$object->setSlug($this->_slugger->slugify($name));
    }

	/**
	 * Set all data that is consistent between Advert types
	 *
	 * @param Advert $advert
	 */
	protected function _buildAdvert( Advert &$advert )
	{
		$advert->setDescription("Short description of advert.");
		// randomize the creation time for more effective sorting testing
		$advert->setCreatedAt($this->_getRandomDate());

		// Set relations to random items
		/** @var City $city */
		$city = $this->_getRandomEntity(City::class, $this->cities);
		$advert->setCity($city);

		/** @var Category $cat */
		$cat = $this->_getRandomEntity(Category::class, $this->categories);
		$advert->setCategory($cat);
    }

	/**
	 * @return \DateTime
	 */
	protected function _getRandomDate()
	{
		return new \DateTime(
			'@' . mt_rand(0, strtotime('now'))
		);
    }

	/**
	 * @param string $entityName
	 * @param array $options
	 *
	 * @return null|object
	 */
	protected function _getRandomEntity( $entityName, $options )
	{
		return $this->_manager
			->getRepository($entityName)
			->findOneBy(
				[ 'name' => $options[mt_rand(0, count($options)-1)] ]
			);
    }

}
