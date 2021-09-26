<?php

namespace HK\CoreBundle\Repository;

use HK\CoreBundle\Master\MasterRepository;
use Doctrine\ORM\QueryBuilder;

class CustomerProductWarrantyRepository extends MasterRepository
{

    protected $hasContent = false;

    public function customQuery($data, QueryBuilder $query): QueryBuilder
    {
        if (isset($data['customer_id']) && intval($data['customer_id']) > 0) {
            $query->andWhere('tbl.customer = :customer_id')->setParameter(':customer_id', $data['customer_id']);
        }
        return parent::customQuery($data, $query);
    }
}
