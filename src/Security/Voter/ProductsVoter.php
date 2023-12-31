<?php

namespace App\Security\Voter;

use App\Entity\Products;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductsVoter extends Voter{
    const EDIT = 'PRODUCT_EDIT';
    const DELETE = 'PRODUCT_DELETE';

    private $security;

    public function __construct(SecurityBundleSecurity $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $product):bool
    {
        if(!in_array($attribute, [self::EDIT, self::DELETE])){
            return false;
        }
        if(!$product instanceof Products){
            return false;
        }
        return true;

        // ou ->>return in_array($attribute,[self::EDIT, self::DELETE]) && $product instanceOf Products;
    }

    protected function voteOnAttribute($attribute, $product, TokenInterface $token): bool
    {
       //recup utilisateur/token
        $user = $token->getUser();

        if(!$user instanceof UserInterface) return false;
        
        //verif si utilisateur est admin
        if($this->security->isGranted('ROLE_ADMIN'))return true;
       
        //verif les permissions si pas admin
        switch($attribute){
            case self::EDIT:
                //verif si utilisateur peut editer
                return $this->canEdit();
                break;
            case self::DELETE:
                //verif si utilisateur peut supprimer
                return $this->canDelete();
                break;
        }
    }
   
    private function canEdit(){
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }    
    private function canDelete(){
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }
}    