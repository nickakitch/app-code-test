<?php

namespace Controllers;

use Exception;

class StoreCallDetails
{
    /**
     * @throws Exception
     */
    public function __invoke(array $callDetails): \Models\Call
    {
        $this->validateCallDetails($callDetails);
        $this->storeCallDetails($callDetails);
        $this->updateCallTotalTime($callDetails);

        return \Models\Call::find($callDetails['call_id']);
    }

    private function validateCallDetails(array $callDetails): void
    {
        if (empty($callDetails['call_id'])) {
            throw new Exception('Call ID is required');
        }
        if (empty($callDetails['date'])) {
            throw new Exception('Call details date is required');
        }

        if (empty($callDetails['details'])) {
            throw new Exception('Call details are required');
        }

        if (empty($callDetails['hours']) && $callDetails['hours'] !== '0') {
            throw new Exception('Call hours is required');
        }

        if (empty($callDetails['minutes']) && $callDetails['minutes'] !== '0') {
            throw new Exception('Call minutes is required');
        }

        if (!is_numeric($callDetails['hours'])) {
            throw new Exception('Call hours must be numeric');
        }

        if (!is_numeric($callDetails['minutes'])) {
            throw new Exception('Call minutes must be numeric');
        }
    }

    private function storeCallDetails(array $callDetails): void
    {
        $totalMinutes = ($callDetails['hours'] * 60) + $callDetails['minutes'];

        $database = \Controllers\Database::getInstance();

        $statement = $database->prepare('INSERT INTO `call_details` (`call_id`, `date`, `details`, `total_time_in_minutes`) VALUES (:call_id, :date, :details, :total_time_in_minutes)');
        $statement->execute([
            'call_id' => $callDetails['call_id'],
            'date' => $callDetails['date'],
            'details' => $callDetails['details'],
            'total_time_in_minutes' => $totalMinutes,
        ]);
    }

    private function updateCallTotalTime(array $callDetails): void
    {
        $database = \Controllers\Database::getInstance();

        $statement = $database->prepare('SELECT SUM(`total_time_in_minutes`) AS `total_time_in_minutes` FROM `call_details` WHERE `call_id` = :call_id');
        $statement->execute(['call_id' => $callDetails['call_id']]);

        $totalTime = $statement->fetchColumn();

        $statement = $database->prepare('UPDATE `calls` SET `total_time_in_minutes` = :total_time_in_minutes WHERE `id` = :call_id');
        $statement->execute([
            'total_time_in_minutes' => $totalTime,
            'call_id' => $callDetails['call_id'],
        ]);
    }
}