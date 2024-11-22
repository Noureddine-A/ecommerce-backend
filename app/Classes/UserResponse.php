<?php
namespace App\Classes;

use App\Classes\Response;

class UserResponse extends Response {
    private $isAdmin;

    public function __construct(string $responseMessage, bool $isAdmin) {
        parent::__construct($responseMessage);
        $this->isAdmin = $isAdmin;
    }
}
?>