<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class LoginController extends AbstractController
{
    /**
     * @var CsrfTokenManagerInterface|null
     */
    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

    public function __invoke(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('ttskch_user_profile_show');
        }

        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif ($session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null;
        }

        $lastUsername = !$session ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->tokenManager
            ? $this->tokenManager->getToken('authenticate')->getValue()
            : null
        ;

        return $this->render('@!TtskchUser/Security/login.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error,
            'csrfToken' => $csrfToken,
        ]);
    }
}
