<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Firebase\JWT\JWT;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[Route('/post')]
class PostController extends AbstractController
{
   /* #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }*/
    #[Route('/list', name: 'app_post_indexf', methods: ['GET'])]
    public function index_front(PostRepository $postRepository): Response
    {
        return $this->render('post/indexf.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        // Handle file upload
        $file = $form->get('image')->getData();

        // Move the file to the desired location
        $file->move(
            $this->getParameter('images_directory'), // defined in services.yaml
            $fileName
        );

        // Set the file name in the entity
        $post->setImage($fileName);
            // Enregistrez le post dans la base de données
            $entityManager->persist($post);
            $entityManager->flush();
    
            // Envoyez une notification FCM
           // $this->sendFCMNotification($post->getTitle());
    
            // Redirection vers la liste des posts
            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
    
    /*private function sendFCMNotification(string $message): void
    {
    $clientToken = 'LE_TOKEN_DU_CLIENT';

    // Configurez votre clé secrète pour signer le JWT
    $apiKey = 'VOTRE_CLE_SECRETE_FCM';

    // Créez un JWT pour l'authentification
    $token = [
        'iss' => 'VOTRE_SENDER_ID',
        'sub' => 'VOTRE_SENDER_ID',
        'iat' => time(),
        'exp' => time() + 3600,
    ];

    $jwt = JWT::encode($token, $apiKey, 'HS256');

    // Construire le chemin complet vers le fichier serviceAccountKey.json
    $projectDir = $this->getParameter('kernel.project_dir');
    $serviceAccountPath = $projectDir . '/src/Controller/serviceAccountKey.json';

    // Chargez le fichier serviceAccountKey.json
    $serviceAccount = ServiceAccount::fromJsonFile($serviceAccountPath);

    // Configurez Firebase avec votre service account
    $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();

    // Récupérez le Cloud Messaging (FCM) du projet Firebase
    $messaging = $firebase->getMessaging();

    // Envoyez la notification à FCM
    $messaging->send([
        'to' => $clientToken,
        'notification' => [
            'title' => 'Nouveau Post',
            'body' => $message,
        ],
    ], $jwt);
    }*/
    #[Route('/{idPost}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{idPost}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
    
            if ($file) {
                // Generate a unique name for the file
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
    
                // Move the file to the directory where images are stored
                $file->move(
                    $this->getParameter('images_directory'), // defined in services.yaml
                    $fileName
                );
    
                // Set the file name in the entity
                $post->setImage($fileName);
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
    

    /*#[Route('/{idPost}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getIdpost(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }*/
#[Route('/{idPost}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, PostRepository $postRepository, MailerInterface $mailer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getIdPost(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
               
            $email = (new Email())
            ->from('asmazakraoui4@gmail.com')
            ->to('asma.zakraoui@esprit.tn ')
            ->subject('Supression de post')
            ->html('<p>Un post a été suprrimé:</p>' .
            '<ul>' .
            '<li>id du post: ' . $post->getIdPost() . '</li>' .
            '<li>description: ' . $post->getDescription() . '</li>' .
            '<li>image: ' . $post->getImage() . '</li>' .
            '</ul>');


        $mailer->send($email);
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,PaginatorInterface $paginator,Request $request): Response
    {   
        $searchTerm = $request->query->get('q');
        $post=[];
        if (!empty($searchTerm)) {
            $posts = $entityManager
            ->getRepository(Post::class)
            ->findByDescription($searchTerm);
            $page = $paginator->paginate(
                $posts,
                $request->query->getInt('page', 1),
                3 
            );
            
        }
        else{
            $posts = $entityManager
            ->getRepository(Post::class)
            ->findAll();
            $page = $paginator->paginate(
                $posts,
                $request->query->getInt('page', 1),
                1
            );
           
        }
        

        return $this->render('post/index.html.twig', [
            'page' => $page,
            'searchTerm' => $searchTerm,
        ]);
    }
    
}
