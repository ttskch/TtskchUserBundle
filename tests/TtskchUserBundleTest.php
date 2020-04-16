<?php

declare(strict_types=1);

namespace Ttskch\UserBundle;

use PHPUnit\Framework\TestCase;

class TtskchUserBundleTest extends TestCase
{
    /**
     * @var TtskchUserBundle
     */
    protected $bundle;

    protected function setUp(): void
    {
        $this->bundle = new TtskchUserBundle();
    }

    public function testIsInstanceOfUserBundle(): void
    {
        $actual = $this->bundle;
        $this->assertInstanceOf(TtskchUserBundle::class, $actual);
    }
}
