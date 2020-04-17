<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\Controller\Security;

class LogoutController
{
    public function __invoke()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
