<?php
namespace App\Controller;

use App\Repository\DeliveryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class deliveryController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class deliveryController {

    private $deliveryRepository;

    public function __construct(DeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    /**
     * @Route("delivery", name="add_delivery", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $idBeneficiarie = $data['idBeneficiarie'];
        $kg = $data['kg'];
        $date = $data['date'];

        if (empty($idBeneficiarie) || empty($kg) || empty($date)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->deliveryRepository->saveDelivery($idBeneficiarie, $kg, $date);

        return new JsonResponse(['status' => 'Delivery created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("delivery/{id}", name="get_one_delivery", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $delivery = $this->deliveryRepository->findOneBy(['id' => $id]);

        $data = [
            'idBeneficiarie' => $delivery->getId_beneficiarie(),
            'kg' => $delivery->getKg(),
            'date' => $delivery->getDate(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("deliverys", name="get_all_delivery", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $deliveries = $this->deliveryRepository->findAll();
        $data = [];

        foreach ($deliveries as $delivery) {
            $data[] = [
                'id' => $delivery->getId(),
                'idBeneficiarie' => $delivery->getId_beneficiarie(),
                'kg' => $delivery->getKg(),
                'date' => $delivery->getDate(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("delivery/{id}", name="update_delivery", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $delivery = $this->deliveryRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['idBeneficiarie']) ? true : $delivery->setId_beneficiarie($data['idBeneficiarie']);
        empty($data['kg']) ? true : $delivery->setKg($data['kg']);
        empty($data['date']) ? true : $delivery->setDate($data['date']);

        $updatedDelivery= $this->deliveryRepository->updateDelivery($delivery);

		return new JsonResponse(['status' => 'Delivery updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("delivery/{id}", name="delete_delivery", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $delivery = $this->deliveryRepository->findOneBy(['id' => $id]);

        $this->deliveryRepository->removeIdentificacion($delivery);

        return new JsonResponse(['status' => 'Delivery deleted'], Response::HTTP_OK);
    }
}

?>