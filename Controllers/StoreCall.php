<?php

namespace Controllers;

use Models\Call;

class StoreCall
{
    private int|false $newCallId;

    /**
     * @throws \Exception
     */
    public function __invoke(array $callDetails)
    {
        $this->validateCallDetails($callDetails);
        $this->storeCall($callDetails);

        if ($this->newCallId === false) {
            throw new \Exception('Unable to store call');
        }

        return Call::find($this->newCallId);
    }

    private function validateCallDetails(array $callDetails)
    {
        if (empty($callDetails['call_date'])) {
            throw new \Exception('Please select a date');
        }

        if (empty($callDetails['call_it_person'])) {
            throw new \Exception('Please enter the name of the IT person');
        }

        if (empty($callDetails['call_username'])) {
            throw new \Exception('Please enter your username');
        }

        if (empty($callDetails['call_subject'])) {
            throw new \Exception('Please enter a subject');
        }

        if (empty($callDetails['call_details'])) {
            throw new \Exception('Please enter call details');
        }

        if (empty($callDetails['call_status'])) {
            throw new \Exception('Please select a status');
        }

        if (!in_array($callDetails['call_status'], ['new', 'in_progress', 'resolved'])) {
            throw new \Exception('Please select a valid status');
        }

        if (!strtotime($callDetails['call_date'])) {
            throw new \Exception('Call date is invalid');
        }

        if (strlen($callDetails['call_it_person']) > 32) {
            throw new \Exception('IT person name must be less than 32 characters');
        }

        if (strlen($callDetails['call_username']) > 32) {
            throw new \Exception('Username must be less than 32 characters');
        }

        if (strlen($callDetails['call_subject']) > 64) {
            throw new \Exception('Subject must be less than 64 characters');
        }
    }

    private function storeCall(array $callDetails)
    {
        $database = Database::getInstance();
        $statement = $database->prepare('INSERT INTO `calls` (`date`, `it_person`, `username`, `subject`, `details`, `status`) VALUES (:date, :it_person, :username, :subject, :details, :status)');
        $statement->execute([
            'date' => $callDetails['call_date'],
            'it_person' => $callDetails['call_it_person'],
            'username' => $callDetails['call_username'],
            'subject' => $callDetails['call_subject'],
            'details' => $callDetails['call_details'],
            'status' => $callDetails['call_status']
        ]);

        $this->newCallId = $database->lastInsertId();
    }
}