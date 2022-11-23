<?php 
namespace ApiCar\infraestructure\driver;

use ApiCar\domain\driver\Driver;
use ApiCar\domain\driver\DriverRepository;
use ApiCar\domain\Email;
use ApiCar\infraestructure\ConnectionManager;
use DomainException;
use MongoDB\Operation\FindOneAndUpdate;

class DriverRepositoryMongo implements DriverRepository
{
    private $connection;

    private $collection = "drivers";

    public function __construct()
    {
        $this->connection = ConnectionManager::connect();
        $this->collection = $this->connection->selectCollection($this->collection);
    }

    public function addDriver(Driver $driver): void
    {
        $id = $this->getNextId();

        $document = [
            "_id" => $id,
            "name" => $driver->getName(),
            "email" => strval($driver->getEmail()),
            "birthdate" => $driver->getBirthdate()->format("Y-m-d")
        ];

        $this->collection->insertOne($document);
    }

    public function findDriverById(int $id): Driver
    {
        $driver = $this->collection->find(["_id" => $id])->toArray();
        
        if(empty($driver)) {
            throw new DomainException("Driver not found");
        }

        $driver = current($driver);
        return Driver::create($driver['name'], $driver['email'], $driver['birthdate']);
    }

    public function findByEmail(Email $email): Driver
    {
        $driver = $this->collection->find(["email" => strval($email)])->toArray();
        
        if(empty($driver)) {
            throw new DomainException("Driver not found");
        }

        $driver = current($driver);
        return Driver::create($driver['name'], $driver['email'], $driver['birthdate']);
    }

    public function findAllDrivers(): array
    {
        return $this->collection->find()->toArray();

    }

    public function deleteDriver(int $id): void
    {
        $this->collection->deleteOne(["_id" => $id]);
    }

    /**
     * Generate id
     *
     * @return integer
     */
    private function getNextId(): int
    {
        $collection = $this->connection->selectCollection("counters");

        $result = $collection->findOneAndUpdate(
            ['_id' => 'driver_id'],
            ['$inc' => ['seq' => 1]],
            ['upsert' => true, 'projection' => ['seq' => 1], 'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );

        return $result['seq'];
    }
}