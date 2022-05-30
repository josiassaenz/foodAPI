<?php
namespace App\Controller;

use App\Repository\TypeRoadRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class typeRoadController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class typeRoadController {

    private $typeRoadRepository;

    public function __construct(TypeRoadRepository $typeRoadRepository)
    {
        $this->typeRoadRepository = $typeRoadRepository;
    }

    /**
     * @Route("typeroad", name="add_typeroad", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $code = $data['code'];
        $keyRoad = $data['keyRoad'];

        if (empty($code) || empty($keyRoad)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->typeRoadRepository->saveTypeRoad($code, $keyRoad);

        return new JsonResponse(['status' => 'Type TypeRoad created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("typeroad/{id}", name="get_one_typeroad", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $typeroad = $this->typeRoadRepository->findOneBy(['id' => $id]);

        $data = [
            'code' => $typeroad->getCode(),
            'keyRoad' => $typeroad->getKeyRoad(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("typeroads", name="get_all_typeroads", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $typeRoads = $this->typeRoadRepository->findAll();
        $data = [];

        foreach ($typeRoads as $typeRoad) {
            $data[] = [
                'id' => $typeRoad->getId(),
                'code' => $typeRoad->getCode(),
                'keyRoad' => $typeRoad->getKeyRoad(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("typeroad/{id}", name="update_typeroad", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $typeRoad = $this->typeRoadRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['code']) ? true : $typeRoad->setCode($data['name']);
        empty($data['keyRoad']) ? true : $typeRoad->setKeyRoad($data['keyRoad']);

        $updatedTypeRoad= $this->typeRoadRepository->updateTypeRoad($typeRoad);

		return new JsonResponse(['status' => 'Type TypeRoad updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("typeroad/{id}", name="delete_typeroad", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $typeRoad = $this->typeRoadRepository->findOneBy(['id' => $id]);

        $this->typeRoadRepository->removeTypeRoad($typeRoad);

        return new JsonResponse(['status' => 'Type TypeRoad deleted'], Response::HTTP_OK);
    }
}
