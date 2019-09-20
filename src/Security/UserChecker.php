<?php


namespace App\Security;

use App\Entity\User as AppUser;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// information see here: https://symfony.com/doc/current/security/user_checkers.html

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        if (!$user->isConfirmed()) {
            throw new CustomUserMessageAuthenticationException('Du musst Deine E-Mail Adresse noch bestätigen!!!');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }



    }
}