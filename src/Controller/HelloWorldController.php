<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class HelloWorldController extends AbstractController
{
    #[Route('/hello/world', name: 'app_hello_world')]
    public function index(): Response
    {
        $arrPokemons = [
            ['number' => 1, 'name' => 'Bulbizarre', 'type' => 'Plante'],
            ['number' => 2, 'name' => 'Salamèche', 'type' => 'Feu'],
            ['number' => 3, 'name' => 'Carapuce', 'type' => 'Eau'],
        ];

        return $this->render('hello_world/index.html.twig', [
            'controller_name' => 'HelloWorldController',
            'pokemonList'     => $arrPokemons
        ]);
    }

    #[Route('/mail', name: 'app_test_mail')]
    public function sendMail(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail)
            ->from('hello@grisou.fr')
            ->to('test@hotmail.fr')
            ->subject('Pokémon Grisou')
            ->text('Sending emails is fun again!') // FORMAT TEXT
            ->html('<p>Grisouuuuuuuuuuuuuuuu BATON</p>');
        $mailer->send($email);

        return $this->redirectToRoute('app_hello_world');
    }
}
