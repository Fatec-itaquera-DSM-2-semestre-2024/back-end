<?php

namespace App\Controller;
use App\Model\Model;
class SoftwareController {
    private $db;

    public function __construct() {
        $this->db = new Model();
    }

}