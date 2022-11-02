<?php

 namespace App\Controller;


 use App\Entity\User;
 use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 use Symfony\Component\Security\Core\User\UserInterface;

 class AuthController extends ApiController
 {

   /**
    * @Route("/api/register", name="register", methods={"POST"})
    * @param Request $request
    * @param UserPasswordEncoderInterface $encoder
    * @return JsonResponse
    */
   public function register(Request $request, UserPasswordEncoderInterface $encoder): JsonResponse
   {
      $em = $this->getDoctrine()->getManager();
      
      $request = $this->transformJsonBody($request);
      // $username = $request->get('username');
      $password = $request->get('password');
      $email = $request->get('email');
      $rol = $request->get('rol');
      $isActive = $request->get('isActive');

      // if (empty($password) || empty($email) || empty($rol) || empty($isActive)){
      //  return $this->respondValidationError("Invalid Username or Password or Email");
      // }


      $user = new User($email);
      // $user->setPassword($encoder->encodePassword($user, $password));
      $user->setPassword($encoder->encodePassword($user, $password));
      // $user->setUsername($username);
      $user->setEmail($email);
      $user->setRoles([$rol]);
      $user->setIsActive($isActive);
      $em->persist($user);
      $em->flush();
      return $this->respondWithSuccess(sprintf('Facilitador %s fue creado con éxito', $user->getUsername()));
   }

  /**
   * @param UserInterface $user
   * @param JWTTokenManagerInterface $JWTManager
   * @return JsonResponse
   */
  public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $JWTManager)
  {
   return new JsonResponse(['token' => $JWTManager->create($user)]);
   // return new JsonResponse($this->jwtManager = $jwtManager);
  }

 }