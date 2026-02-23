<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
 /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request ,EntityManagerInterface $entityManager): Response
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

            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 /**
     * @Route("/save", name="user_save")
     */
    public function save(Request $req ,Connection $connection,UserPasswordEncoderInterface $passwordEncoder ){
        $fname =$req->get('fname'); 
        $lname =$req->get('lname'); 
        $email =$req->get('email'); 
        $password =$req->get('password'); 
        $age =$req->get('age'); 
        $numtel =$req->get('numtel'); 
        $sex =$req->get('sex'); 
        $user = new User();
        $hashedPassword = $passwordEncoder->encodePassword($user,$password);
        $data = [
            'nom' => $fname,
            'prenom' => $lname, 
            'email' => $email, 
            'mdp' =>   $hashedPassword,
            'role' => 'Utilisateur', 
            'img' => 'null', 
            'age' => $age, 
            'numtel'=>$numtel,
            'sex' => $sex,
            // add more columns and values as needed
        ];

        $tableName = 'user';

        $query = 'INSERT INTO ' . $tableName . ' (' . implode(', ', array_keys($data)) . ') 
                  VALUES (' . implode(', ', array_map(function ($value) {
            return '\'' . $value . '\'';
        }, $data)) . ')';

        $statement = $connection->prepare($query);
      if(  $statement->execute()){
        return $this->redirectToRoute('app_login');
      }
    }
    #[Route('/profile', name: 'user_profile')]
    public function userProfile(): Response
    {
        // Fetch the user information from your data source (e.g., database)
        $user = $this->getUser(); // Assuming you're using Symfony's security system

        return $this->render('/home/profile.html.twig', [
            'user' => $user,
            'enableFields' => false, // Set to true or false based on your logic
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_user_profile_edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager,UserRepository $userRepository): Response
    {
        return $this->renderForm('home/profile.html.twig', [
            'user' => $user,
           
            'enableFields' => false, // Set to true or false based on your logic
            'image_path' => $user->getImg()
        ]);
    }

    #[Route('/save/{id}', name: 'app_user_profile_save')]

    public function saveData(User $user, Request $request, Connection $connection): Response
    {
        // Get the data from the request
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $numtel = $request->get('numtel');
        $email = $request->get('email');
        $age = $request->get('age');
    
        // Handle file upload
        $file = $request->files->get('img');
      
       
        $fileName = null;
        if($file){
        if ($file instanceof UploadedFile) {
            // Generate a unique name for the file
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where your images are stored
            $file->move(
                $this->getParameter('your_images_directory'),
                $fileName
            );
        }

        $query = '
        UPDATE user
        SET nom = :nom, prenom = :prenom, numtel = :numtel, age = :age, email = :email, img = :img
        WHERE id = :user_id
    ';

    $parameters = [
        'nom' => $nom,
        'prenom' => $prenom,
        'numtel' => $numtel,
        'email' => $email,
        'age' => $age,
        'img' => $fileName,
        'user_id' => $user->getId(),
    ];
        }else{
            $query = '
            UPDATE user
            SET nom = :nom, prenom = :prenom, numtel = :numtel, age = :age, email = :email
            WHERE id = :user_id
        ';
    
        $parameters = [
            'nom' => $nom,
            'prenom' => $prenom,
            'numtel' => $numtel,
            'email' => $email,
            'age' => $age,
            'user_id' => $user->getId(),
        ];
        }
        
    
        if ($connection->executeQuery($query, $parameters)) {
            return $this->redirectToRoute('user_profile');
        } else {
            return $this->renderForm('home/profile.html.twig', [
                'user' => $user,
                'enableFields' => false, // Set to true or false based on your logic
                'image_path' => $user->getImg(),
            ]);
        }
    }
    
}
