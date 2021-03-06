<?php

namespace IntoPeople\DatabaseBundle\Entity;

/**
 * GeneralcycleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GeneralcycleRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function getAmountCdpsByFormstatus($formstatus) {
    
        $query = $this->createQueryBuilder('g')
        ->select('count(f)')
        ->leftjoin('g.feedbackcycles','f')
        ->leftjoin('f.cdp','c')
        ->where('c.formstatus = :formstatus')
        ->andWhere('g.generalcyclestatus = :active')
        ->setParameter('formstatus', $formstatus)
        ->setParameter('active', 1);
    
        return $query->getQuery()->getSingleScalarResult();
    }
    
    
    public function getActiveCycleByOrganization() {
               
        $qb = $this->createQueryBuilder('g')
        ->where('g.generalcyclestatus = 1')
        ->getQuery();
        
        return $qb->setMaxResults(1)->getOneOrNullResult();
        
    }
    
    public function getFinishedCyclesByOrganization() {
               
        $qb = $this->createQueryBuilder('g')
        ->where('g.generalcyclestatus = :generalcyclestatus')
        ->setParameter('generalcyclestatus', $this->_em->getReference('IntoPeopleDatabaseBundle:Generalcyclestatus', 2))
        ->getQuery();
        
        return $qb->getResult();
        
    }
    
    public function getInactiveCyclesByOrganization() {
         
        $qb = $this->createQueryBuilder('g')
        ->where('g.generalcyclestatus = :generalcyclestatus')
        ->setParameter('generalcyclestatus', $this->_em->getReference('IntoPeopleDatabaseBundle:Generalcyclestatus', 3))
        ->getQuery();
    
        return $qb->getResult();
    
    }
    
    public function checkYearByOrganization($year) {
         
        $qb = $this->createQueryBuilder('g')
        ->andWhere('g.year = :year')
        ->setParameter('year', $year)
        ->getQuery();
    
        return $qb->getResult();
    
    }
    
}
