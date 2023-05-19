<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Security\BiscuiterieAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UserController extends AbstractController
{
    #[Route('/member', name: 'app_user')]
    public function index(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $userPasswordHasher,UserAuthenticatorInterface $userAuthenticator,BiscuiterieAuthenticator $authenticator): Response
    {
        $user = $this->getUser();
        $userForm = $this->createForm(UserFormType::class,$user);
        $userForm->handleRequest($request);
        if( $userForm->isSubmitted()&& $userForm->isValid() ){
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $userForm->get('password')->getData()
                )
            );

            $em->persist($user);
            $em->flush();

        }
      
// dd( $this->getUser());

        return $this->render('user/index.html.twig', [
            
            
            'userForm' => $userForm
        ]);
    }
}
