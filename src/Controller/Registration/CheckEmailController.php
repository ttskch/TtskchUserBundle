<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\Controller\Registration;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckEmailController extends AbstractController
{
    const SESSION_KEY = 'ttskch_user/confirmation_sent_email';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $userClassName;

    public function __construct(EntityManagerInterface $em, string $userClassName)
    {
        $this->em = $em;
        $this->userClassName = $userClassName;
    }

    public function __invoke(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('ttskch_user_profile_show');
        }

        $email = $request->getSession()->get(self::SESSION_KEY);

        if (!$email) {
            return $this->redirectToRoute('ttskch_user_registration_register');
        }

        $request->getSession()->remove(self::SESSION_KEY);

        $user = $this->em->getRepository($this->userClassName)->findOneBy(['email' => $email]);

        if (!$user) {
            return $this->redirectToRoute('ttskch_user_security_login');
        }

        return $this->render('@!TtskchUser/Registration/check_email.html.twig', [
            'user' => $user,
        ]);
    }
}
