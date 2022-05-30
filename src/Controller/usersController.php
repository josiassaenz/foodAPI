<?php
namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class usersController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class usersController {
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @Route("user", name="add_user", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $names = $data['names'];
        $firstSurname = $data['firstSurname'];
        $secondSurname = $data['secondSurname'];
        $email = $data['email'];
        $celPhone = $data['celPhone'];
        $password = $data['password'];
        $token = $data['token'];
        $isActive = $data['isActive'];

        if (empty($name) || empty($type)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->usersRepository->saveUser($names, $firstSurname, $secondSurname, $email, $celPhone, $password, $token, $isActive);

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("user/{id}", name="get_one_user", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $user = $this->usersRepository->findOneBy(['id' => $id]);

        $data = [
            'names' => $user->getNames(),
            'firstSurname' => $user->getFirstSurname(),
            'secondSurname' => $user->getsecondSurname(),
            'email' => $user->getEmail(),
            'celPhone' => $user->getCelPhone(),
            'password' => $user->getPassword(),
            'token' => $user->getToken(),
            'isActive' => $user->getIsActive(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("users", name="get_all_users", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $users = $this->usersRepository->findAll();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'names' => $user->getNames(),
                'firstSurname' => $user->getFirstSurname(),
                'secondSurname' => $user->getsecondSurname(),
                'email' => $user->getEmail(),
                'celPhone' => $user->getCelPhone(),
                'password' => $user->getPassword(),
                'token' => $user->getToken(),
                'isActive' => $user->getIsActive(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("user/{id}", name="update_user", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $user = $this->usersRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['names']) ? true : $user->setNames($data['names']);
        empty($data['firstSurname']) ? true : $user->setFirstSurname($data['firstSurname']);
        empty($data['secondSurname']) ? true : $user->setSecondSurname($data['secondSurname']);
        empty($data['email']) ? true : $user->setEmail($data['email']);
        empty($data['celPhone']) ? true : $user->setCelPhone($data['celPhone']);
        empty($data['password']) ? true : $user->setPassword($data['password']);
        empty($data['token']) ? true : $user->setToken($data['token']);
        empty($data['isActive']) ? true : $user->setToken($data['isActive']);

        $updatedUser = $this->usersRepository->updateUser($user);

		return new JsonResponse(['status' => 'User updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $user = $this->usersRepository->findOneBy(['id' => $id]);

        $this->usersRepository->removeUser($user);

        return new JsonResponse(['status' => 'User deleted'], Response::HTTP_OK);
    }
}

?>