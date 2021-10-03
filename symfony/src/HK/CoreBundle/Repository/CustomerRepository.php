<?php

namespace HK\CoreBundle\Repository;

use DateInterval;
use DateTime;
use HK\CoreBundle\Master\MasterRepository;
use Doctrine\ORM\QueryBuilder;
use HK\CoreBundle\Entity\CustomerProductWarranty;
use Symfony\Component\VarDumper\VarDumper;

class CustomerRepository extends MasterRepository
{

    protected $hasContent = false;

    public function customQuery($data, QueryBuilder $query): QueryBuilder
    {
        if (isset($data['is_warranty']) && $data['is_warranty']) {
            $warrantyDate = new DateTime();
            $warrantyDate->add(new DateInterval('P3M'));
            $query->leftJoin('tbl.warranties', 'w')
                ->andWhere('w.warrantyDate <= :warranty AND w.status = :status')
                ->setParameter(':warranty', $warrantyDate->format('Y-m-d 23:59:59'))
                ->setParameter(':status', CustomerProductWarranty::$_STATUS_WAITING);
        }
        return parent::customQuery($data, $query);
    }
    public function addFilterKeyword($data, $query)
    {
        if (isset($data['keyword']) && is_array($data['keyword'])) {
            if (!isset($data['keyword']['search_fields']) || count($data['keyword']['search_fields']) <= 0) {
                $data['keyword'] = [
                    'search_fields' => [],
                    'search_by' => ''
                ];
            }
            if (!empty($data['keyword']['search_by']) && count($data['keyword']['search_fields'])) {
                $sqlLike = '(tbl.id < -1';
                $sqlContentLike = '(lgc.id < -1';
                foreach ($data['keyword']['search_fields'] as $col) {
                    if (is_array($col) && isset($col['content']) && $col['content']) {
                        $sqlContentLike .= ' OR (lgc.' . $col['key'] . ' LIKE :keyword)';
                        continue;
                    }
                    $sqlLike .= ' OR (tbl.' . $col . ' LIKE :keyword)';
                }
                if (isset($data['is_warranty']) && $data['is_warranty']) {
                    $sqlLike .= ' OR (w.statusContent LIKE :keyword)';
                }

                if ($this->hasContent) {
                    $sqlLike .= ') OR ' . $sqlContentLike . ')';
                    if ($sqlLike != '(tbl.id < -1) OR (lgc.id < -1)') {
                        $query = $query->andWhere($sqlLike);
                    }
                } else {
                    $sqlLike .= ')';
                    if ($sqlLike != '(tbl.id < -1)') {
                        $query = $query->andWhere($sqlLike);
                    }
                }

                $query = $query->setParameter('keyword', $data['keyword']['search_by']);
            }
        }
        return $query;
    }
}
