<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ChargedFeesRepository extends EntityRepository
{

    public function findLastChargedFees()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT fees FROM App:ChargedFees fees WHERE fees.state='loaded' ORDER BY fees.id ASC"
            )
            ->getResult();
    }
}