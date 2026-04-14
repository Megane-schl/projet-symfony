<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(Request $request, LoggerInterface $logger): Response
    {
        // dd($request->query->get('last', 10));

        $logger->info("Affichage");

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    // #[Route('/pokemon/{id}', name: 'app_pokemon_show')]
    // public function show(int $id): Response
    // {
    //     return $this->render('pokemon/show.html.twig', [
    //         'pokemon_id' => $id
    //     ]);
    // }
}
