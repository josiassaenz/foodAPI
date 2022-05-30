<?php
namespace App\Controller;

use App\Repository\CountriesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class countriesController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class countriesController {

    private $countriesRepository;

    public function __construct(CountriesRepository $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    /**
     * @Route("country", name="add_country", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $nombre = $data['nombre'];
        $iso = $data['iso'];

        if (empty($name) || empty($nombres) || empty($iso)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->countriesRepository->saveCountries($names, $nombres, $iso);

        return new JsonResponse(['status' => 'Country created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("country/{id}", name="get_one_country", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $countries = $this->countriesRepository->findOneBy(['id' => $id]);

        $data = [
            'name' => $countries->getName(),
            'nombre' => $countries->getNombre(),
            'iso' => $countries->getIso(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("countries", name="get_all_countries", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $countries = $this->countriesRepository->findAll();
        $data = [];

        foreach ($countries as $country) {
            $data[] = [
                'id' => $country->getId(),
                'name' => $country->getName(),
                'nombre' => $country->getNombre(),
                'iso' => $country->getIso(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("country/{id}", name="update_country", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $countries = $this->countriesRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['name']) ? true : $countries->setName($data['name']);
        empty($data['nombre']) ? true : $countries->setNombre($data['nombre']);
        empty($data['iso']) ? true : $countries->setIso($data['iso']);

        $updatedCountries= $this->countriesRepository->updateCountries($countries);

		return new JsonResponse(['status' => 'Country updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("country/{id}", name="delete_country", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $countries = $this->countriesRepository->findOneBy(['id' => $id]);

        $this->countriesRepository->removeIdentificacion($countries);

        return new JsonResponse(['status' => 'Country deleted'], Response::HTTP_OK);
    }
}

?>