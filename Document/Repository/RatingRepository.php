<?php

namespace Desarrolla2\Bundle\BlogBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\Query\ResultSetMapping;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ODM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends DocumentRepository
{

    /**
     * @param $entityName
     * @param $entityId
     *
     * @return int
     */
    public function getRatingFor($entityName, $entityId)
    {
        $em = $this->getDocumentManager();
        $qb = $em->createQueryBuilder();

        $qb->field('entityName')->equals($entityName);
        $qb->field('entityId')->equals($entityId);

        $results = $qb->getQuery()->execute();

        /** @var \MongoCollection $results */
        $filtered = $results->aggregate([
            '$group' => [
                '_id' => null,
                'sum' => ['$sum' => '$rating']
            ]
        ])
        ;

        return $filtered['results'][0]['sum'];
    }

    /**
     * @param $entityName
     * @param $entityId
     *
     * @return int
     */
    public function getVotesFor($entityName, $entityId)
    {
        $em = $this->getDocumentManager();
        $qb = $em->createQueryBuilder();

        $qb->field('entityName')->equals($entityName);
        $qb->field('entityId')->equals($entityId);

        return $qb->getQuery()->execute()->count();
    }
}
