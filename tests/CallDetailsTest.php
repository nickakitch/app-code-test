<?php

class CallDetailsTest extends \PHPUnit\Framework\TestCase
{
    public function test_find_call_details_based_on_call_id(): void
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

        $statement = $database->prepare('INSERT INTO `call_details` (`call_id`, `date`, `details`, `total_time_in_minutes`) VALUES (:call_id, :date, :details, :total_time_in_minutes)');
        $statement->execute([
            'call_id' => $callId,
            'date' => '2021-01-01',
            'details' => 'Test details',
            'total_time_in_minutes' => 90,
        ]);

        $callDetails = \Models\CallDetails::forCall($callId);

        $this->assertEquals($callId, $callDetails[0]['call_id']);
    }
}