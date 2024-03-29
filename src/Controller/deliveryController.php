<?php

namespace App\Controller;

use App\Repository\DeliveryRepository;
use App\Repository\BeneficiariesRepository;
use App\Entity\Delivery;
use App\Entity\Beneficiaries;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class usersController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class deliveryController {
    private $deliveryRepository;
    private $beneficiariesRepository;

    public function __construct(DeliveryRepository $deliveryRepository , BeneficiariesRepository $beneficiariesRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->beneficiariesRepository = $beneficiariesRepository;
    }

    /**
     * @Route("delivery", name="add_delivery", methods={"POST"})
     */
    public function add(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $idBeneficiarie = $data['idBeneficiarie'];
        $kg = $data['kg'];
        $date = $data['date'];

        if (empty($idBeneficiarie) || empty($kg) || empty($date)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->deliveryRepository->saveDelivery($idBeneficiarie, $kg, $date);

        return new JsonResponse(['status' => 'Datos registrados!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("delivery/{id}", name="get_one_delivery", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $delivery = $this->deliveryRepository->findOneBy(['id' => $id]);

        $data = [
            'idBeneficiarie' => $delivery->getIdBeneficiarie(),
            'kg' => $delivery->getKg(),
            'date' => $delivery->getDate(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("deliverysDate", name="get_date_delivery", methods={"GET"})
     */
    public function getAllDeliverysDate(): JsonResponse
    {
        // $deliverysDate = $this->deliveryRepository->findByDateDeliverys();
        $deliverysDate = $this->deliveryRepository->findAll();
        $users = $this->beneficiariesRepository->findAll();
        // $customer = $deliverysDate->getRepository(Beneficiafies::class)->findAll();
        $data = [];

        // $combined = array_combine($deliverysDate, $users);
        $before = 0;
        $after = 0;

        foreach ($deliverysDate as $delivery) {
            $before = $delivery->getId();
            // echo 'Antes: '.$before;
            foreach ($users as $user) {
                if($before !== $after){
                    $data[] = [
                        'id' => $delivery->getId(),
                        'names' => $user->getNames(),
                        'firstSurname' => $user->getFirstSurname(),
                        'secondSurname' => $user->getSecondSurname(),
                        'celPhone' => $user->getCelPhone(),
                        'kg' => $delivery->getKg(),
                        'signture' => $user->getSignture(),
                    ];
                }
                $after = $before;
                // echo 'después: '.$after;
            }
        }

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
                'idBeneficiarie' => $delivery->getIdBeneficiarie(),
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
