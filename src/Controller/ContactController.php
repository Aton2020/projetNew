<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\Helpers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{

    private $app;
    private $db;
    private $userInfo;
    private $session;

    public function __construct(ManagerRegistry $doctrine, Helpers $app, RequestStack $requestStack)
    {
        $this->app = $app;
        $this->db = $doctrine->getManager();
        $this->userInfo = $app->getUser();
        $this->session = $requestStack->getSession();
    }

    #[Route('/contact', name: 'app_contact')]
    
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        if($this->getUser()) {
            $contact->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class, $contact );

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $entityManager = $this->db;
            $entityManager->persist($contact);
            $entityManager->flush();

            // Email:

            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('info@bc-sissi.fr')
                ->subject($contact->getSujet())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $contact,
                    'username' => 'foo',
                ]);
        
            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre demande a bien été envoyé'
            );

            return $this->redirectToRoute('app_contact');
        }
        

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'userInfo' => $this->userInfo,
        ]);
    }
}