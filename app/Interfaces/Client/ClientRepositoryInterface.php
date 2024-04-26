<?php
namespace App\Interfaces\Client;

use stdClass;

interface ClientRepositoryInterface
{
    /**
     * Store client.
     * @return mixed
     */
    public function storeClient(array $data): stdClass;

    public function getClients(array $options): stdClass;

    public function getClient(int $clientid, bool $withreferral = true): stdClass;

    public function updateClient(array $data): stdClass;

    public function authenticated(array $data): stdClass;

    public function updatePassword(array $data): stdClass;

    public function getRelations(int $clientid): stdClass;

    public function logout(): void;
}
