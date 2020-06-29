<?php

namespace DoctrineExtensions\Tests\Entities;

/**
 * @Entity
 */
class DatePeriod
{
    /** @Id @Column(type="string") @GeneratedValue */
    public $id;

    /**
     * @Column(type="DateTime")
     */
    public $started;

    /**
     * @Column(type="DateTime")
     */
    public $finished;
}
