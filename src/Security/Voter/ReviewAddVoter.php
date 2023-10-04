<?php

namespace App\Security\Voter;

use DateTime;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ReviewAddVoter extends Voter
{
    // la fonction supports
    // est appelée pour savoir
    // si notre voter veut participer au vote
    // décider si oui ou non on autorise
    protected function supports(string $attribute, $subject): bool
    {
        if ($attribute === 'MOVIE_REVIEW_ADD' && $subject instanceof \App\Entity\Movie)
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        // grace au subject on peut prendre une décision plus précise en fonction de l'objet fourni
        // on a également accès à l'utilisateur connecté actuellement grace à l'objet $token ( $token->getUser() )
        return true;
    }
}