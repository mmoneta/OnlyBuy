<?php
    require_once 'SecurityAppController.php';

    class SessionController extends SecurityAppController {
        public function __construct() {
            parent::__construct();
        }

        public function session(string $param) {
            if ($param == 'user') {
                http_response_code(200);
                echo json_encode($_SESSION['user']);
            }

            if ($param == 'logOut') {
                session_unset();
                http_response_code(200);
                echo json_encode(true);
            }

            http_response_code(404);
        }
    }