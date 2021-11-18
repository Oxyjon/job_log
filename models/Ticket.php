<?php

namespace app\models;

use app\Database;

class Ticket
{
    // Declare ticket variables
    public ?int $id = null;
    public ?string $title = null;
    public ?string $bookedBy = null;
    public ?string $createdDate = null;
    public ?string $dateDue = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $phoneNumber = null;
    public ?string $device = null;
    public ?string $status = null;
    public ?float $quotedPrice = null;
    public ?string $body = null;
    public ?string $location = null;


    // Load ticket Data
    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
        $this->bookedBy = $data['bookedBy'];
        $this->createdDate = $data['createdDate'];
        $this->dateDue = $data['dateDue'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->phoneNumber = $data['phoneNumber'];
        $this->device = $data['device'];
        $this->status = $data['status'];
        $this->quotedPrice = $data['quotedPrice'];
        $this->body = $data['body'];
        $this->location = $data['location'];
    }
    // Save Ticket to the DB
    public function save()
    {

        $errors = [];
        // Form validation
        if (!$this->title || !$this->body || !$this->bookedBy || !$this->firstName || !$this->lastName || !$this->phoneNumber
        || !$this->device || !$this->status || !$this->quotedPrice || !$this->location) {
            $errors[] = 'Ticket form is required in all fields';
        }

        // If error array is empty create/update ticket
        if (empty($errors)) {

            $db = Database::$db;
            // If id exists update existing else create
            if ($this->id) {
                $db->updateTicket($this);
            } else {
                $db->createTicket($this);
            }
        }
        // Else return the error
        return $errors;
    }
}
