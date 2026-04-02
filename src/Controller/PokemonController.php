<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonCreateFormType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pokemon', name: 'app_pokemon_')]

final class PokemonController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $arrPokemon = $pokemonRepository->findAll();

        return $this->render('pokemon/index.html.twig', [
            'pokemonList' => $arrPokemon,
        ]);
    }


    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        /*
        if($request->isMethod('POST')) {

            $onError = false; //< Flag qui vérifie si tout est OK ou pas

            $strPokemonName     = $request->request->get('name');
            $intPokemonNumber   = $request->request->get('number');

            if($intPokemonNumber <= 0) {

                $onError = true;

                // Je stocke un message "flash" dans la session
                // Attention, flash nécessite une redirection propre '$this->redirectTo...'
                // $this->addFlash('danger', "Le numéro dans le Pokédex doit être supérieur à zéro");
            }

            if(!$onError) {

                $objPokemon = new Pokemon();

                $objPokemon->setName($strPokemonName)
                        ->setNumber($intPokemonNumber);

                $entityManager->persist($objPokemon);

                $entityManager->flush();

                $this->addFlash('success', "Le Pokémon a été créé avec succès !");

                // On redirige vers la page de détails du pokémon qui vient d'être enregistré en base
                return $this->redirectToRoute('app_pokemon_show', [
                    'id' => $objPokemon->getId()
                ]);
            }
        }
        */

        $objNewPokemon = new Pokemon();

        $createForm = $this->createForm(PokemonCreateFormType::class, $objNewPokemon);


        // J'envoi les données de la requête au formulaire
        $createForm->handleRequest($request);


        // Vérifie si le formulaire est soumis et que les données sont valides
        if ($createForm->isSubmitted() && $createForm->isValid()) {

            $entityManager->persist($objNewPokemon);
            $entityManager->flush();

            $this->addFlash('success', "Le pokémon a bien été crée en base");

            return $this->redirectToRoute('app_pokemon_show', [
                'id' => $objNewPokemon->getId()
            ]);
        }


        return $this->render('pokemon/form.html.twig', [
            'createForm'    => $createForm
        ]);
    }

    //c'est une expression régulière qui permet de valider mon paramètre : obligé que ce soit un nombre -> \d un chiffre et le + : au moins 1
    #[Route('/{id<\d+>}', name: 'show')]
    public function show(Pokemon $pokemon): Response
    {
        /*

        $objPokemon = $pokemonRepository->find($id);


        if (!$objPokemon) {
            throw $this->createNotFoundException(
                "Le Pokémon n'existe pas"
            );
        }

        */
        return $this->render('pokemon/show.html.twig', [
            /*   
            'pokemon_id' => $id,
            'pokemon'    => $objPokemon
            */
            'pokemon' => $pokemon
        ]);
    }

    #[Route('/{id<\d+>}/update', name: 'update')] //< URL : /pokemon/1/update
    public function update(Pokemon $pokemon, Request $request, EntityManagerInterface $entityManager): Response
    {
        // On construit le formulaire à partir des données de l'entité récupérée
        // depuis l'ID présent dans l'URL
        $updateForm = $this->createForm(PokemonCreateFormType::class, $pokemon);

        $updateForm->handleRequest($request);

        if($updateForm->isSubmitted() && $updateForm->isValid()) {

            // L'entité provenant déjà de la base, Doctrine la connait
            // => pas besoin de persist

            $entityManager->flush();

            $this->addFlash('success', "Le pokémon a bien été modifié en base");

            // Redirige vers la page de détails du pokémon modifié
            return $this->redirectToRoute('app_pokemon_show', [
                'id' => $pokemon->getId()
            ]);
        }

        return $this->render('pokemon/form.html.twig', [
            'createForm'    => $updateForm
        ]);
    }
}
