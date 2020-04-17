<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\Controller\Security;

class CheckController
{
    public function __invoke()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
}
