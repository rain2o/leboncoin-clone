<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advert::class);
    }

	/**
	 * Get all adverts of deal type
	 *
	 * @return Advert[]
	 */
	public function getAllDeals()
	{
		return $this->findByType('deal');
    }

	/**
	 * Get all adverts of request type
	 * @return Advert[]
	 */
	public function getAllRequests()
	{
		return $this->findByType('request');
    }

	/**
	 * Find all adverts by type
	 *
	 * @param string $type
	 *
	 * @return Advert[]
	 */
	public function findByType( $type )
	{
		return $this->createQueryBuilder('a')
		            ->andWhere('a.type = :val')
		            ->setParameter('val', $type)
		            ->orderBy('a.createdAt', 'DESC')
		            ->getQuery()
		            ->getResult();
    }

//    /**
//     * @return Advert[] Returns an array of Advert objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advert
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
