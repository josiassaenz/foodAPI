<?php
namespace App\Controller;

use App\Repository\ProvincesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class provincesController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class provincesController {
    private $provincesRepository;

    public function __construct(ProvincesRepository $provincesRepository)
    {
        $this->provincesRepository = $provincesRepository;
    }

    /**
     * @Route("province", name="add_province", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $code = $data['code'];
        $postalCode = $data['postalCode'];
        $name = $data['name'];
        $phoneCode = $data['phoneCode'];
        $iso2 = $data['iso2'];

        if (empty($code) || empty($postalCode) || empty($name) || empty($phoneCode) || empty($typiso2e)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->provincesRepository->saveProvince($code, $postalCode, $name, $phoneCode, $iso2);

        return new JsonResponse(['status' => 'Province created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("province/{id}", name="get_one_province", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $province = $this->provincesRepository->findOneBy(['id' => $id]);

        $data = [
            'code' => $province->getCode(),
            'postalCode' => $province->getPostalCode(),
            'name' => $province->getName(),
            'phoneCode' => $province->getPhoneCode(),
            'iso2' => $province->getIso2(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("provinces", name="get_all_provinces", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $provinces = $this->provincesRepository->findAll();
        $data = [];

        foreach ($provinces as $province) {
            $data[] = [
                'id' => $province->getId(),
                'code' => $province->getCode(),
                'postalCode' => $province->getPostalCode(),
                'name' => $province->getName(),
                'phoneCode' => $province->getPhoneCode(),
                'iso2' => $province->getIso2(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("province/{id}", name="update_province", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $province = $this->provincesRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['code']) ? true : $province->setCode($data['code']);
        empty($data['postalCode']) ? true : $province->setPostalCode($data['postalCode']);
        empty($data['name']) ? true : $province->setName($data['name']);
        empty($data['phoneCode']) ? true : $province->setPhoneCode($data['phoneCode']);
        empty($data['iso2']) ? true : $province->setIso2($data['iso2']);

        $updatedProvince = $this->provincesRepository->updateProvince($province);

		return new JsonResponse(['status' => 'Province updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("province/{id}", name="delete_province", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $province = $this->provincesRepository->findOneBy(['id' => $id]);

        $this->provincesRepository->removeProvince($province);

        return new JsonResponse(['status' => 'Province deleted'], Response::HTTP_OK);
    }
}

?>