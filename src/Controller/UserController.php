<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user')] 

class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {

        $userCount = $userRepository->count([]);
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'count' => $userCount,

        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]

    public function new(Request $request, EntityManagerInterface $entityManager,UserRepository $userRepository): Response


    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('img')->getData();

            // Generate a unique name for the file
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where your images are stored
            $file->move(
                $this->getParameter('your_images_directory'),
                $fileName
            );

            // Save the image name in the database
            $user->setImg($fileName);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        $userCount = $userRepository->count([]);
        return $this->renderForm('user/new.html.twig', [
            'users' => $user,
            'form' => $form,
            'count' => $userCount,

        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]

    public function show(User $user,UserRepository $userRepository): Response
    {
        $userCount = $userRepository->count([]);
        return $this->render('user/show.html.twig', [
            'users' => $user,
            'count' => $userCount,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, User $user, EntityManagerInterface $entityManager,UserRepository $userRepository): Response

    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('img')->getData();

            // Generate a unique name for the file
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where your images are stored
            $file->move(
                $this->getParameter('your_images_directory'),
                $fileName
            );

            // Save the image name in the database
            $user->setImg($fileName);

            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        $userCount = $userRepository->count([]);
        return $this->renderForm('user/edit.html.twig', [
            'users' => $user,
            'form' => $form,
            'count' => $userCount,
            'image_path' => $user->getImg()
        ]);
    }


    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]

    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_user_deletee', methods: ['GET', 'POST'])]
    public function deletee(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

}
