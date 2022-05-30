<?php
namespace App\Controller;

use App\Repository\IdentificationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class identificationController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class identificationController {

    private $identificationRepository;

    public function __construct(IdentificationRepository $identificationRepository)
    {
        $this->identificationRepository = $identificationRepository;
    }

    /**
     * @Route("identification", name="add_identification", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $typeIdentification = $data['typeIdentification'];

        if (empty($name) || empty($type)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->identificationRepository->saveIdentification($typeIdentification);

        return new JsonResponse(['status' => 'Type Identification created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("identification/{id}", name="get_one_identification", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $identification = $this->identificationRepository->findOneBy(['id' => $id]);

        $data = [
            'typeIdentification' => $identification->getTypeIdentification(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("identifications", name="get_all_identifications", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $identifications = $this->identificationRepository->findAll();
        $data = [];

        foreach ($identifications as $identification) {
            $data[] = [
                'id' => $identification->getId(),
                'typeIdentification' => $identification->getTypeIdentification(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("identification/{id}", name="update_identification", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $identification = $this->identificationRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['typeIdentification']) ? true : $identification->setTypeIdentification($data['typeIdentification']);

        $updatedIdentification= $this->identificationRepository->updateIdentification($identification);

		return new JsonResponse(['status' => 'Type Identification updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("identification/{id}", name="delete_identification", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $identification = $this->identificationRepository->findOneBy(['id' => $id]);

        $this->identificationRepository->removeIdentificacion($identification);

        return new JsonResponse(['status' => 'Type Identification deleted'], Response::HTTP_OK);
    }
}

?>