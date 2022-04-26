<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;


class UserVoter extends Voter
{
    public const EDIT = 'PROFILE_EDIT';
    public const VIEW = 'PROFILE_VIEW';

    private $security;
    
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // est ce que c'est un droit que l'on veut gérer
        if (! in_array($attribute, [self::EDIT, self::VIEW]))
        {
            return false;
        }

        // if (get_class($subject) !==  "\App\Entity\User")
        // est ce que l'objet est bien un user
        if (! $subject instanceof \App\Entity\User)
        {
            return false;
        }

        return true;
        
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                // logic to determine if the user can EDIT
                // return true or false

                if ($user->getUserIdentifier() !== $subject->getUserIdentifier() && ! $this->security->isGranted('ROLE_ADMIN')) {
                    return false;
                }
                return true;

                break;

            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false

                if ($user->getUserIdentifier() !== $subject->getUserIdentifier() && ! $this->security->isGranted('ROLE_ADMIN')) {
                    return false;
                }
                return true;

                break;
        }

        return false;
    }
}
