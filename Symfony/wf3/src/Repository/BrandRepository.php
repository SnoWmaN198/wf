<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class BrandRepository extends EntityRepository
{
    public function findByNameLike(string $pattern) 
    {
        // select * from brand as b where name like '%pattern%'
        $queryBuilder = $this->createQueryBuilder('b');
        $queryBuilder->where($queryBuilder->expr()->like('b.name', ':pattern'));
        $queryBuilder->setParameter('pattern', '%'.$pattern.'%');
        
        return $queryBuilder->getQuery()->getResult();
    }    
}
