<?php

namespace App\Repository;

use App\Entity\Jeton;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jeton|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jeton|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jeton[]    findAll()
 * @method Jeton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JetonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jeton::class);
    }

    public function findByArrayId() {
        return $this->createQueryBuilder('jj')
            ->from($this->getClassName(), 'j', 'jj.id')
            ->orderBy('j.id', 'ASC')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function findByTypeValeur()
    {
        $jetons = $this->createQueryBuilder('j')
            ->orderBy('j.type', 'ASC')
            ->orderBy('j.valeur', 'DESC')
            ->getQuery()
            ->getResult();

        $tJetons = [];
        $tJetons['epice'] = [];
        $tJetons['cuir'] = [];
        $tJetons['tissu'] = [];
        $tJetons['or'] = [];
        $tJetons['diamant'] = [];
        $tJetons['argent'] = [];
        $tJetons['Bonus_3'] = [];
        $tJetons['Bonus_4'] = [];
        $tJetons['Bonus_5'] = [];

        foreach($jetons as $jeton) {
            $tJetons[$jeton->getType()][] = $jeton->getId();
        }

        shuffle($tJetons['Bonus_3']);
        shuffle($tJetons['Bonus_4']);
        shuffle($tJetons['Bonus_5']);

        return $tJetons;
    }

//    /**
//     * @return Jeton[] Returns an array of Jeton objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jeton
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
