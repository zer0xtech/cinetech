<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    #[Route('/catalogue', name: 'app_movie_index', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }

    // public function getMovies(): array
    // {
    //     return [
    //         ['id' => 1, 'title' => 'Alice', 'category' => 'Romance', 'releaseYear' => 2000, 'synopsis' => 'N/A', 'rating' => "3.0"],
    //         ['id' => 2, 'title' => '007', 'category' => 'Action', 'releaseYear' => 2007, 'synopsis' => 'N/A', 'rating' => "4.1"],
    //         ['id' => 3, 'title' => 'D', 'category' => 'Comédie', 'releaseYear' => 2010, 'synopsis' => 'N/A', 'rating' => "3.6"],
    //         ['id' => 4, 'title' => 'Police vs Fl', 'category' => 'Thriller', 'releaseYear' => 800, 'synopsis' => 'N/A', 'rating' => "3.2"],
    //         ['id' => 5, 'title' => 'James Bond', 'category' => 'Action', 'releaseYear' => 2017, 'synopsis' => 'N/A', 'rating' => "4.6"],
    //     ];
    // }

    #[Route('/catalogue/{id}', name: 'nom_movie_show', requirements: ['id' => '\d+'])]
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', ['movie' => $movie]);
    }
    
    #[Route('/catalogue/nouveau', name: 'app_movie_new')]
    public function add_movie(Request $request, EntityManagerInterface $em): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'Le produit a bien été créé.');
            return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('movie/new.html.twig', ['form' => $form]);
    }

    #[Route('/catalogue/{id}/modifier', name: 'app_movie_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Movie $movie, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Les modifications ont été enregistrées.');
            return $this->redirectToRoute('nom_movie_show', ['id' => $movie->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('movie/edit.html.twig', ['form' => $form, 'movie' => $movie]);
    }

    #[Route('/api/catalogue', name: 'api_movie_list')]
    public function api_data(): JsonResponse
    {
        return $this->json(['status' => 'online', 'version' => '1.0.0']);
    }
}
