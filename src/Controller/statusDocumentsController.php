<?php
namespace App\Controller;

use App\Repository\StatusDocumentsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class statusDocumentsController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class statusDocumentsController {

    private $statusDocumentsRepository;

    public function __construct(StatusDocumentsRepository $statusDocumentsRepository)
    {
        $this->statusDocumentsRepository = $statusDocumentsRepository;
    }

    /**
     * @Route("statusDocuments", name="add_statusDocuments", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $statusDocuments = $data['statusDocuments'];

        if (empty($name) || empty($type)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->statusDocumentsRepository->saveStatusDocuments($statusDocuments);

        return new JsonResponse(['status' => 'Type StatusDocuments created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("statusDocuments/{id}", name="get_one_statusDocuments", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $statusDocuments = $this->statusDocumentsRepository->findOneBy(['id' => $id]);

        $data = [
            'statusDocuments' => $statusDocuments->getTypeStatusDocuments(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("statusDocuments", name="get_all_statusDocuments", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $statusDocumentss = $this->statusDocumentsRepository->findAll();
        $data = [];

        foreach ($statusDocumentss as $statusDocuments) {
            $data[] = [
                'id' => $statusDocuments->getId(),
                'statusDocuments' => $statusDocuments->getTypeStatusDocuments(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("statusDocuments/{id}", name="update_statusDocuments", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $statusDocuments = $this->statusDocumentsRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['statusDocuments']) ? true : $statusDocuments->setTypeStatusDocuments($data['statusDocuments']);

        $updatedStatusDocuments= $this->statusDocumentsRepository->updateStatusDocuments($statusDocuments);

		return new JsonResponse(['status' => 'Type StatusDocuments updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("statusDocuments/{id}", name="delete_statusDocuments", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $statusDocuments = $this->statusDocumentsRepository->findOneBy(['id' => $id]);

        $this->statusDocumentsRepository->removeIdentificacion($statusDocuments);

        return new JsonResponse(['status' => 'Type StatusDocuments deleted'], Response::HTTP_OK);
    }
}

?>