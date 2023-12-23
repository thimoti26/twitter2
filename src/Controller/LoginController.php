<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\SerializerInterface;

class LoginController extends AbstractController
{
    use HandleTrait;

    /**
     * @param MessageBusInterface $messageBus
     * @param SerializerInterface $serializer
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(
        MessageBusInterface                  $messageBus,
        private readonly SerializerInterface $serializer,
        private readonly AuthenticationUtils $authenticationUtils
    )
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): Response
    {
        // get the login error if there is one
        $error = $this->authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
