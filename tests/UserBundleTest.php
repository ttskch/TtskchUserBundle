<?php

declare(strict_types=1);

namespace Ttskch\UserBundle;

use PHPUnit\Framework\TestCase;

class UserBundleTest extends TestCase
{
    /**
     * @var UserBundle
     */
    protected $userBundle;

    protected function setUp(): void
    {
        $this->userBundle = new UserBundle();
    }

    public function testIsInstanceOfUserBundle(): void
    {
        $actual = $this->userBundle;
        $this->assertInstanceOf(UserBundle::class, $actual);
    }
}
