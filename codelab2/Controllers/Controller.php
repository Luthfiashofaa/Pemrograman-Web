<?php

namespace Controller;

require_once "Traits/ResponseFormatter.php"; // Gunakan require_once

use Traits\ResponseFormatter;

class ProductController {
    use ResponseFormatter;

    public function getAllProduct() {
        $dummyData = [
            "Air Mineral",
            "Kebab",
            "Spagetti",
            "Jus Jambu"
        ];

        $response = [
            "product" => $dummyData
        ];

        return $this->responseFormatter(200, "Success", $response);
    }
}
