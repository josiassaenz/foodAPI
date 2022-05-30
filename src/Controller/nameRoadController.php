<?php
namespace App\Controller;

use App\Repository\NameRoadRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class nameRoadController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class nameRoadController {

    private $nameRoadRepository;

    public function __construct(NameRoadRepository $nameRoadRepository)
    {
        $this->nameRoadRepository = $nameRoadRepository;
    }

    /**
     * @Route("nameroad", name="add_nameroad", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];

        if (empty($name)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->nameRoadRepository->saveNameRoad($code, $keyRoad);

        return new JsonResponse(['status' => 'Type NameRoad created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("nameroad/{id}", name="get_one_nameroad", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $nameroad = $this->nameRoadRepository->findOneBy(['id' => $id]);

        $data = [
            'name' => $nameroad->getName(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("nameroads", name="get_all_nameroads", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $nameRoads = $this->nameRoadRepository->findAll();
        $data = [];

        foreach ($nameRoads as $nameRoad) {
            $data[] = [
                'id' => $nameRoad->getId(),
                'name' => $nameRoad->getName(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("nameroad/{id}", name="update_nameroad", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $nameRoad = $this->nameRoadRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['name']) ? true : $nameRoad->setCode($data['name']);

        $updatedNameRoad= $this->nameRoadRepository->updateNameRoad($nameRoad);

		return new JsonResponse(['status' => 'Type NameRoad updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("nameroad/{id}", name="delete_nameroad", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $nameRoad = $this->nameRoadRepository->findOneBy(['id' => $id]);

        $this->nameRoadRepository->removeNameRoad($nameRoad);

        return new JsonResponse(['status' => 'Type NameRoad deleted'], Response::HTTP_OK);
    }
}
