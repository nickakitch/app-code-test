<?php

class StoreCallTest extends \PHPUnit\Framework\TestCase
{
    public function test_when_the_store_call_class_is_invoked_with_correct_details_then_a_call_is_stored(): void
    {
        $subject = uniqid('test_');

        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_username' => 'john.doe',
            'call_subject' => $subject,
            'call_details' => 'Call details',
            'call_status' => 'new'
        ];

        $storedCall = (new \Controllers\StoreCall())($callDetails);

        $database = \Controllers\Database::getInstance();
        $statement = $database->prepare('SELECT * FROM `calls` WHERE `subject` = :subject');
        $statement->execute(['subject' => $subject]);

        $results = $statement->fetchAll();

        $this->assertEquals(1, count($results));
    }

    public function test_empty_call_date()
    {
        $callDetails = [
            'call_it_person' => 'John Doe',
            'call_username' => 'johndoe123',
            'call_subject' => 'Test subject',
            'call_details' => 'Test call details',
            'call_status' => 'new',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please select a date');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_empty_call_it_person()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_username' => 'johndoe123',
            'call_subject' => 'Test subject',
            'call_details' => 'Test call details',
            'call_status' => 'new',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please enter the name of the IT person');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_empty_call_username()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_subject' => 'Test subject',
            'call_details' => 'Test call details',
            'call_status' => 'new',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please enter your username');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_empty_call_subject()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_username' => 'johndoe123',
            'call_details' => 'Test call details',
            'call_status' => 'new',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please enter a subject');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_empty_call_details()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_username' => 'johndoe123',
            'call_subject' => 'Test subject',
            'call_status' => 'new',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please enter call details');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_empty_call_status()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_username' => 'johndoe123',
            'call_subject' => 'Test subject',
            'call_details' => 'Test call details',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please select a status');

        (new \Controllers\StoreCall())($callDetails);
    }

    public function test_invalid_call_status()
    {
        $callDetails = [
            'call_date' => '2021-01-01',
            'call_it_person' => 'John Doe',
            'call_username' => 'johndoe123',
            'call_subject' => 'Test subject',
            'call_details' => 'Test call details',
            'call_status' => 'invalid',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Please select a valid status');

        (new \Controllers\StoreCall())($callDetails);
    }
}