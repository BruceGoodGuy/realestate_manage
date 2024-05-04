<?php

namespace App\Interfaces\Contract;

use stdClass;

interface ContractRepositoryInterface
{
    /**
     * Store Contract.
     * @return mixed
     */
    public function storeContract(array $data): stdClass;
    public function getContracts(): stdClass;
    public function getContract(int $id): stdClass;
    public function updateContract(array $data): stdClass;
    public function deleteContract(int $id): stdClass;
    public function getInitData(): stdClass;
    public function confirmTransaction(int $id, bool $isaccept): stdClass;
}
