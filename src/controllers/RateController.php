<?php

namespace src\controllers;

use src\repository\RateRepository;

class RateController extends SecurityAppController
{
    private RateRepository $rateRepository;

    public function __construct()
    {
        parent::__construct();
        $this->rateRepository = new RateRepository();
    }

    public function rate(): void
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json);

        $rate = $this->rateRepository->createRate(
            $data->productId,
            $_SESSION['user']->getUserId(),
            $data->value
        );

        http_response_code(200);
        echo json_encode($rate);
    }
}