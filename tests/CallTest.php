<?php

class CallTest extends \PHPUnit\Framework\TestCase
{
    public function test_find_a_call(): void
    {
        $database = \Controllers\Database::getInstance();

        $statement = $database->prepare('INSERT INTO `calls` (`date`, `it_person`, `username`, `subject`, `details`, `status`) VALUES (:date, :it_person, :username, :subject, :details, :status)');
        $statement->execute([
            'date' => '2021-01-01',
            'it_person' => 'John Doe',
            'username' => 'john.doe',
            'subject' => 'Test subject',
            'details' => 'Test details',
            'status' => 'new'
        ]);

        $callId = $database->lastInsertId();
        $call = \Models\Call::find($callId);

        $this->assertEquals($callId, $call->id);
    }
}