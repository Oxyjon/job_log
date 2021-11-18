<?php

namespace app\models;

use app\Database;

class Note
{
    // Declare note variables
    public ?int $id = null;
    public ?int $ticket_id = null;
    public ?string $body = null;



    // Load Note Data
    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->ticket_id = $data['ticket_id'] ?? null;
        $this->body = $data['body'] ?? null;
    }
    // Save Note to the DB
    public function save()
    {
        $errors = [];
        if (!$this->body) {
            $errors[] = 'Note Body is required';
        }

        // If error array is empty create/update ticket
        if (empty($errors)) {

            $db = Database::$db;

            $db->createNote($this);
        }
        // Else return the error
        return $errors;
    }
}
