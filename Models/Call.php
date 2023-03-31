<?php

namespace Models;

use Controllers\Database;
use stdClass;

class Call
{
    public function __construct(
        public int $id,
        public string $date,
        public string $it_person,
        public string $username,
        public string $subject,
        public string $details,
        public string $total_time_in_minutes,
        public string $status,
        public string $created_at,
        public ?string $deleted_at,
    ) {}

    /**
     * @param int $callId
     * @return false|Call|stdClass|null
     */
    public static function find(int $callId): false|Call|stdClass|null
    {
        $database = Database::getInstance();

        $statement = $database->prepare('SELECT * FROM `calls` WHERE `id` = :id');
        $statement->execute(['id' => $callId]);

        return new self(...(array) $statement->fetchObject());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'it_person' => $this->it_person,
            'username' => $this->username,
            'subject' => $this->subject,
            'details' => $this->details,
            'total_time_in_minutes' => $this->total_time_in_minutes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}