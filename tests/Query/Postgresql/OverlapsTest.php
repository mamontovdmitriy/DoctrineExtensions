<?php

namespace DoctrineExtensions\Tests\Query\Postgresql;

use Doctrine\ORM\QueryBuilder;
use DoctrineExtensions\Tests\Query\PostgresqlTestCase;

class OverlapsTest extends PostgresqlTestCase
{
    public function testOverlaps()
    {
        $queryBuilder = new QueryBuilder($this->entityManager);
        $queryBuilder
            ->select("overlaps(dp.started, dp.finished, dp.started, dp.finished)")
            ->from('DoctrineExtensions\Tests\Entities\DatePeriod', 'dp');

        $expected = "SELECT (d0_.started, d0_.finished) OVERLAPS (d0_.started, d0_.finished) AS sclr_0 FROM DatePeriod d0_";

        $this->assertEquals($expected, $queryBuilder->getQuery()->getSQL());
    }
}
