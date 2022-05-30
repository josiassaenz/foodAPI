<?php
namespace App\Controller;

use App\Repository\BeneficiariesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class beneficiariesController
 * @package App\Controller
 *
//  * @Route(path="/api/")
 * @Route("/api/")
 */
class beneficiariesController {
    private $beneficiariesRepository;

    public function __construct(BeneficiariesRepository $beneficiariesRepository)
    {
        $this->beneficiariesRepository = $beneficiariesRepository;
    }

    /**
     * @Route("beneficiarie", name="add_beneficiarie", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $names = $data['names'];
        $firstSurname = $data['firstSurname'];
        $secondSurname = $data['secondSurname'];
        $celPhone = $data['celPhone'];
        $typeIdentification = $data['typeIdentification'];
        $numberIdentification = $data['numberIdentification'];
        $born = $data['born'];
        $email = $data['email'];
        $signture = $data['signture'];
        $country = $data['country'];
        $province = $data['province'];
        $location = $data['location'];
        $nameRoad = $data['nameRoad'];
        $otherDirection = $data['otherDirection'];
        $termsConditions = $data['termsConditions'];

        if (empty($name) || empty($typeIdentification)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->beneficiariesRepository->saveUser($names, $firstSurname, $secondSurname, $celPhone, $typeIdentification, $numberIdentification, $born, $email, $signture, $country, $province, $location, $nameRoad, $otherDirection, $termsConditions);

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("beneficiarie/{id}", name="get_one_beneficiarie", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $user = $this->beneficiariesRepository->findOneBy(['id' => $id]);

        $data = [
            'names' => $user->getNames(),
            'firstSurname' => $user->getFirstSurname(),
            'secondSurname' => $user->getSecondSurname(),
            'celPhone' => $user->getCelPhone(),
            'typeIdentification' => $user->getTypeIdentificacion(),
            'numberIdentification' => $user->getNumberIdentification(),
            'born' => $user->getBorn(),
            'email' => $user->getEmail(),
            'signture' => $user->getSignture(),
            'country' => $user->getCountry(),
            'province' => $user->getProvince(),
            'location' => $user->getLocation(),
            'nameRoad' => $user->getNameRoad(),
            'otherDirection' => $user->getOtherDirection(),
            'termsConditions' => $user->getTermsConditions(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("beneficiaries", name="get_all_beneficiaries", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $users = $this->beneficiariesRepository->findAll();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'names' => $user->getNames(),
                'firstSurname' => $user->getFirstSurname(),
                'secondSurname' => $user->getSecondSurname(),
                'celPhone' => $user->getCelPhone(),
                'typeIdentification' => $user->getTypeIdentificacion(),
                'numberIdentification' => $user->getNumberIdentification(),
                'born' => $user->getBorn(),
                'email' => $user->getEmail(),
                'signture' => $user->getSignture(),
                'country' => $user->getCountry(),
                'province' => $user->getProvince(),
                'location' => $user->getLocation(),
                'nameRoad' => $user->getNameRoad(),
                'otherDirection' => $user->getOtherDirection(),
                'termsConditions' => $user->getTermsConditions(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("beneficiarie/{id}", name="update_beneficiarie", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $user = $this->beneficiariesRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['names']) ? true : $user->setNames($data['names']);
        empty($data['firstSurname']) ? true : $user->setFirstSurname($data['firstSurname']);
        empty($data['secondSurname']) ? true : $user->setSecondSurname($data['secondSurname']);
        empty($data['celPhone']) ? true : $user->setCelPhone($data['celPhone']);
        empty($data['typeIdentification']) ? true : $user->setTypeIdentification($data['typeIdentification']);
        empty($data['numberIdentification']) ? true : $user->setNumberIdentification($data['numberIdentification']);
        empty($data['born']) ? true : $user->setBorn($data['born']);
        empty($data['email']) ? true : $user->setEmail($data['email']);
        empty($data['signture']) ? true : $user->setSignture($data['signture']);
        empty($data['country']) ? true : $user->setCountry($data['country']);
        empty($data['province']) ? true : $user->setProvince($data['province']);
        empty($data['location']) ? true : $user->setLocation($data['location']);
        empty($data['nameRoad']) ? true : $user->setNameRoad($data['nameRoad']);
        empty($data['otherDirection']) ? true : $user->setOtherDirection($data['otherDirection']);
        empty($data['termsConditions']) ? true : $user->setTermsConditions($data['termsConditions']);

        $updatedUser = $this->beneficiariesRepository->updateUser($user);

		return new JsonResponse(['status' => 'User updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("beneficiarie/{id}", name="delete_beneficiarie", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $user = $this->beneficiariesRepository->findOneBy(['id' => $id]);

        $this->beneficiariesRepository->removeUser($user);

        return new JsonResponse(['status' => 'User deleted'], Response::HTTP_OK);
    }
}

?>