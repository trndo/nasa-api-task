<?php

namespace App\Repository;

use App\Entity\Asteroid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @method Asteroid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asteroid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asteroid[]    findAll()
 * @method Asteroid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsteroidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asteroid::class);
    }

    /**
     * Find asteroid by date
     */
    public function findOneByDate(string $date): ?Asteroid
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.date = :date')
            ->setParameter('date', $date)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Find all hazardous asteroids
     */
    public function findAllHazardous(ParameterBag $parameterBag): Paginator
    {
        $count = $parameterBag->getInt('count', 10);
        $page = $parameterBag->getInt('page', 1);

        $qb = $this->createQueryBuilder('a')
                ->andWhere('a.isHazardous = 1')
                ->orderBy('a.date', 'DESC');

        $this->addPaging($qb, $page, $count);

        return new Paginator($qb->getQuery(), false);
    }

    public function findOneTheFastest(ParameterBag $parameterBag): ?Asteroid
    {
        $isHazardous = $parameterBag->getBoolean('hazardous', false);

        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.isHazardous = :isHazardous')
            ->orderBy('a.speed', 'DESC')
            ->setParameter('isHazardous', $isHazardous)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findBestMonth(ParameterBag $parameterBag)
    {
        $isHazardous = $parameterBag->getBoolean('hazardous', false);

        $qb = $this->createQueryBuilder('a')
            ->select('a.date')
            ->setParameter('isHazardous', $isHazardous)
            ->groupBy('MONTH(a.date)')
            ->orderBy('COUNT(a.id)', 'DESC')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get hazardous asteroids count
     */
    public function getTotalRowsHazardous(
        ParameterBag $parameterBag
    ): int {
        $paginator = $this->findAllHazardous($parameterBag);

        return $paginator->count();
    }

    /**
     * Adding pagination method
     */
    private function addPaging(
        QueryBuilder $qb,
        int $page = 1,
        int $count = 0
    ): void {
        // Prevent setting page value less than 0
        $startResult = max($page - 1, 0) * $count;
        $qb->setFirstResult($startResult);

        if ($count > 0) {
            $qb->setMaxResults($count);
        }
    }
}
