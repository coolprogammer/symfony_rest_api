<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Movie;
/**
 * @Route("/api/v1", name="api_")
 */

class MovieController extends AbstractController
{
    /**
     * @Route("/movies", name="all_movies", methods={"GET"})
     */
    public function index(): Response
    {
        
        $products = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->findAll();
           
        $data = [];
 
        foreach ($products as $product) {
           $data[] = [
               'id' => $product->getId(),
               'name' => $product->getName(),
               #'description' => $product->getDescription(),
           ];
        }
 
 
        return $this->json($products);
    }

    /**
     * @Route("/movies", name="movies_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
 
        $project = new Movie();
        $project->setName($request->request->get('name'));
        $project->setDirector($request->request->get('director'));
 
        $entityManager->persist($project);
        $entityManager->flush();
 
        return $this->json('Created new movie successfully with id ' . $project->getId());
    }

    /**
     * @Route("/movie/{id}", name="movies_show", methods={"GET"})
     */

    public function show(int $id): Response
    {
        $movie = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->find($id);
 
        if (!$movie) {
 
            return $this->json('No project found for id ' . $id, 404);
        }
         
        return $this->json($movie);
    }

    /**
     * @Route("/movie/{id}", name="movie_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
       
        $entityManager = $this->getDoctrine()->getManager();
        $movie = $entityManager->getRepository(Movie::class)->find($id);
 
        if (!$movie) {
            return $this->json('No movie found for id ' . $id, 404);
        }
 
        $movie->setName($request->request->get('name'));
        $movie->setDirector($request->request->get('director'));
        $entityManager->flush();
         
        return $this->json($movie);
    }

    /**
     * @Route("/movie/{id}", name="movie_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $movie = $entityManager->getRepository(Movie::class)->find($id);
 
        if (!$movie) {
            return $this->json('No project found for id ' . $id, 404);
        }
 
        $entityManager->remove($movie);
        $entityManager->flush();
 
        return $this->json('Deleted a project successfully with id ' . $id);
    }




}
