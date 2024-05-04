<?php

namespace App\Interfaces\Property;

use stdClass;

interface PropertyRepositoryInterface
{
    public function storeProperty(array $data): stdClass;
    public function getProperties(array $option): stdClass;
    public function getProperty(int $id): stdClass;
    public function updateProperty($data): stdClass;
}
