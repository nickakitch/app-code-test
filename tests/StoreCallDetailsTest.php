<?php

class StoreCallDetailsTest extends \PHPUnit\Framework\TestCase
{
    public function test_when_the_store_call_details_class_is_invoked_with_correct_details_then_a_call_is_stored(): void
    {
        $details = uniqid('test_');

        (new \Controllers\StoreCallDetails())([
            'call_id' => 1,
            'date' => '2021-01-01',
            'details' => $details,
            'hours' => 1,
            'minutes' => 45
        ]);

        $database = \Controllers\Database::getInstance();
        $statement = $database->prepare('SELECT * FROM `call_details` WHERE `details` = :details');
        $statement->execute(['details' => $details]);

        $results = $statement->fetchAll();

        $this->assertEquals(1, count($results));
    }
}