<?php

namespace Models;

use Controllers\Database;
use stdClass;

class CallDetails
{
    public function __construct(
        public int $id,
        public int $call_id,
        public string $date,
        public string $details,
        public int $total_time_in_minutes,
        public string $created_at,
        public ?string $deleted_at,
    ) {}

    /**
     * @param int $callId
     * @return false|CallDetails|stdClass|null
     */
    public static function find(int $callId): false|CallDetails|stdClass|null
    {
        $database = Database::getInstance();

        $statement = $database->prepare('SELECT * FROM `call_details` WHERE `id` = :id');
        $statement->execute(['id' => $callId]);

        return new self(...(array) $statement->fetchObject());
    }

    /**
     * @param int $callId
     * @param bool $withDeleted
     * @return bool|array
     */
    public static function forCall(int $callId, bool $withDeleted = false): bool|array
    {
        $database = Database::getInstance();

        $statement = $database->prepare('SELECT * FROM `call_details` WHERE `call_id` = :call_id' . ($withDeleted ? '' : ' AND `deleted_at` IS NULL'));
        $statement->execute(['call_id' => $callId]);

        return $statement->fetchAll();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'call_id' => $this->call_id,
            'date' => $this->date,
            'details' => $this->details,
            'total_time_in_minutes' => $this->total_time_in_minutes,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}