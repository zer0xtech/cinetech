<?php

namespace App\Controller;

use App\Entity\Movie;
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

    #[Route('/api/catalogue', name: 'api_movie_list')]
    public function api_data( ): JsonResponse
    {
        return $this->json(['status' => 'online', 'version' => '1.0.0']);
    }
}
