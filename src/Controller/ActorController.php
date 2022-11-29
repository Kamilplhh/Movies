<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Rating;
use App\Repository\ActorRepository;
use App\Form\ActorFormType;
use App\Form\ActorEditFormType;
use App\Form\RatingFormType;
use App\Repository\MovieactorRepository;
use App\Repository\MovieRepository;
use App\Repository\RatingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    private $em;
    private $actorRepository;
    public function __construct(ActorRepository $actorRepository, EntityManagerInterface $em) 
    {
        $this->actorRepository = $actorRepository;
        $this->em = $em;
    }

    #[Route('/myprofile/{id}', methods: ['GET'], name: 'profile')]
    public function home($id, UserRepository $userRepository, RatingRepository $ratingRepository): Response
    { 
        $this->actorRepository->findAll();
        $user = $userRepository->find($id);
        $ratings = $ratingRepository->findBy(['User' => $id]);

        
        return $this->render('myprofile.html.twig', [
            'user' => $user,
            'ratings' => $ratings,
        ]);
    }

    #[Route('/actors', name: 'app_actor')]
    public function index(): Response
    {
        $actors = $this->actorRepository->findAll();
        
        return $this->render('movies/actor.html.twig', [
            'actors' => $actors
        ]);
    }

    #[Route('/actors/{id}', name: 'show_actor')]
    public function show($id, RatingRepository $ratingRepository, MovieactorRepository $movieactorRepository, userRepository $userRepository, Request $request): Response
    {
        $ratingNew = new Rating();
        $form = $this->createForm(RatingFormType::class, $ratingNew);
        $user = $this->getUser();
        $actor = $this->actorRepository->find($id);
        $rating = $ratingRepository->findBy(['Actorid' => $id]);
        $movies = $movieactorRepository
            ->findBy(['actorID' => $id]);
    
        if (count($rating)==0){
            $rating = 0;
        };
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ratedA = $ratingRepository->findOneBy(['Actorid' => $id, 'User' => $user]);
            
            if($ratedA){
                $ratedA->setrating($form->get('Rating')->getData());

                $this->em->persist($ratedA);
                $this->em->flush();

            }else{

                $ratingNew->setrating($form->get('Rating')->getData());
                $ratingNew->setActorid($actor);
                $ratingNew->setUser($user);

                $this->em->persist($ratingNew);
                $this->em->flush();
            }
                
            return $this->redirectToRoute('movies');
        }

        return $this->render('movies/showActor.html.twig', [
            'actor' => $actor,
            'rating' => $rating,
            'movies' => $movies,
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/movies/acreate', name: 'create_actor')]
    public function create(Request $request,): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorFormType::class, $actor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $newActor = $form->getData();
        
            $imagePath = $form->get('imagePath')->getData();
            if ($imagePath){
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir'). '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newActor->setImagePath('/uploads/' . $newFileName);
                
            }
            
            $this->em->persist($newActor);
            $this->em->flush();

            return $this->redirectToRoute('movies');
        }

        return $this->render('movies/acreate.html.twig', [
            'form' => $form->createView()
        ]);        
    }

    #[Route('/movies/deleteA/{id}', methods: ['GET', 'DELETE'], name: 'delete_actor')]
    public function delete($id): Response
    {
        $actor = $this->actorRepository->find($id);
        $this->em->remove($actor);
        $this->em->flush();

        return $this ->redirectToRoute('movies');
    }

    #[Route('/movies/edita/{id}', name:'edit_actor')]
    public function edit($id, Request $request): Response
    {   
        $actor = $this->actorRepository->find($id);
        $form = $this->createForm(ActorEditFormType::class, $actor);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($actor->getImagePath() !== null) {
                    $this->getParameter('kernel.project_dir') . $actor->getImagePath();

                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir'). '/public/uploads',
                            $newFileName
                        );
                        } catch (FileException $e) {
                            return new Response($e->getMessage());
                        }
            
                    $actor->setImagePath('/uploads/' . $newFileName);
                            
                    $this->em->flush();
                            
                    return $this->redirectToRoute('app_actor');
                }
            } else {
                $actor->setName($form->get('name')->getData());

                $this->em->flush();
                return $this->redirectToRoute('app_actor');
            }
        }

        return $this->render('movies/edita.html.twig', [
            
            'actor' => $actor,
            
            'form' => $form->createView(),
        ]);
    }
}
