<?php
namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class locationController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class locationController {

    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * @Route("location", name="add_delivery", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $codeMunicipality = $data['codeMunicipality'];
        $nameMunicipality = $data['nameMunicipality'];
        $codeIneMunicipality = $data['codeIneMunicipality'];
        $codeNuts4 = $data['codeNuts4'];
        $nameNuts4 = $data['nameNuts4'];

        if (empty($codeMunicipality) || empty($nameMunicipality) || empty($codeIneMunicipality) || empty($codeNuts4) || empty($nameNuts4)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->locationRepository->saveDelivery($codeMunicipality, $nameMunicipality, $codeIneMunicipality, $codeNuts4, $nameNuts4);

        return new JsonResponse(['status' => 'Location created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("location/{id}", name="get_one_delivery", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $location = $this->locationRepository->findOneBy(['id' => $id]);

        $data = [
            'codeMunicipality' => $location->getCodeMunicipality(),
            'nameMunicipality' => $location->getNameMunicipality(),
            'codeIneMunicipality' => $location->getCodeIneMunicipality(),
            'codeNuts4' => $location->getCodeNuts4(),
            'nameNuts4' => $location->getNameNuts4(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("locations", name="get_all_locations", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $locations = $this->locationRepository->findAll();
        $data = [];

        foreach ($locations as $location) {
            $data[] = [
                'id' => $location->getId(),
                'codeMunicipality' => $location->getCodeMunicipality(),
                'nameMunicipality' => $location->getNameMunicipality(),
                'codeIneMunicipality' => $location->getCodeIneMunicipality(),
                'codeNuts4' => $location->getCodeNuts4(),
                'nameNuts4' => $location->getNameNuts4(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("location/{id}", name="update_delivery", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $location = $this->locationRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['codeMunicipality']) ? true : $location->setCodeMunicipality($data['codeMunicipality']);
        empty($data['nameMunicipality']) ? true : $location->setNameMunicipality($data['nameMunicipality']);
        empty($data['codeIneMunicipality']) ? true : $location->setCodeIneMunicipality($data['codeIneMunicipality']);
        empty($data['codeNuts4']) ? true : $location->setCodeNuts4($data['codeNuts4']);
        empty($data['nameNuts4']) ? true : $location->setNameNuts4($data['nameNuts4']);

        $updatedDelivery= $this->locationRepository->updateDelivery($location);

		return new JsonResponse(['status' => 'Location updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("location/{id}", name="delete_delivery", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $location = $this->locationRepository->findOneBy(['id' => $id]);

        $this->locationRepository->removeLocation($location);

        return new JsonResponse(['status' => 'Location deleted'], Response::HTTP_OK);
    }
}

?>