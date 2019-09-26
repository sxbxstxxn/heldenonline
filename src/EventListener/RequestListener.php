<?php


namespace App\EventListener;

use App\User\UserManager;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class RequestListener
{

    public function __construct(TokenStorageInterface $t, RouterInterface $r, UserManager $manager)
    {
        $this->tokenStorage = $t;
        $this->router = $r;
        $this->manager = $manager;
    }

    public function onKernelRequest(RequestEvent $event)
    {

        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
        }

        if ($this->tokenStorage->getToken()) {
            $currentUsername = $this->tokenStorage->getToken()->getUsername();
        }
        else {
            $currentUsername = 'anon.';
        }

        $currentURL = $this->router->getContext()->getPathInfo();
        $activityTimestamp = time();

        //file_put_contents('test.txt', $currentURL);

        if ($currentUsername != 'anon.' && $currentURL != '/userlist') {
            $this->manager->setLastActivity($currentUsername, $activityTimestamp);
        }
        if ($currentUsername != 'anon.' && $currentURL == '/logout') {
            $this->manager->setLastActivity($currentUsername, 0);
        }

        return;
        // ...
    }
}