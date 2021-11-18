<?php

namespace app;

use PDO;
use app\models\Ticket;
use app\models\Note;

class Database
{
    // Entry into DB
    public \PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=logger_app', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    // TICKETS //

    public function getTickets($search = '')
    // Get Tickets and search params
    {
        if ($search) {
            $statement = $this->pdo->prepare('SELECT * FROM ticket WHERE title LIKE :title ORDER BY id ASC');
            $statement->bindValue(':title', "%$search%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM ticket ORDER BY id ASC');
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTicketById($id)
    // Get ticket by ID
    {
        $statement = $this->pdo->prepare('SELECT * FROM ticket WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getNoteById($id)
    // Get Notes by ID
    {
        $statement = $this->pdo->prepare('SELECT * FROM note WHERE ticket_id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNote(Note $note)
    // Create New Note
    {
        $statement = $this->pdo->prepare("INSERT INTO note (ticket_id, body)
                        VALUES(:ticket_id, :body)");
        $statement->bindValue(':ticket_id', $note->ticket_id);
        $statement->bindValue(':body', $note->body);
        $statement->execute();
    }

    public function createTicket(Ticket $ticket)
    // Create Ticket
    {

        $statement = $this->pdo->prepare("INSERT INTO ticket (title, bookedBy, createdDate, dateDue, firstName, lastName, phoneNumber, device, status, quotedPrice, body, location)
                        VALUES(:title, :bookedBy, :createdDate, :dateDue, :firstName, :lastName, :phoneNumber, :device, :status, :quotedPrice, :body, :location)");
        $statement->bindValue(':title', $ticket->title);
        $statement->bindValue(':bookedBy', $ticket->bookedBy);
        $statement->bindValue(':createdDate', date('d-m-Y'));
        $statement->bindValue(':dateDue', date('d-m-Y', strtotime("+5 days"))); //Default 5 days from created date
        $statement->bindValue(':firstName', $ticket->firstName);
        $statement->bindValue(':lastName', $ticket->lastName);
        $statement->bindValue(':phoneNumber', $ticket->phoneNumber);
        $statement->bindValue(':device', $ticket->device);
        $statement->bindValue(':status', $ticket->status);
        $statement->bindValue(':quotedPrice', $ticket->quotedPrice);
        $statement->bindValue(':body', $ticket->body);
        $statement->bindValue(':location', $ticket->location);
        $statement->execute();
    }

    public function updateTicket(Ticket $ticket)
    // Update ticket
    {
        $statement = $this->pdo->prepare("UPDATE ticket SET title = :title, firstName = :firstName,
        lastName = :lastName, phoneNumber = :phoneNumber, device = :device, status = :status, quotedPrice = :quotedPrice, body = :body, location = :location WHERE id = :id");
        $statement->bindValue(':title', $ticket->title);
        $statement->bindValue(':firstName', $ticket->firstName);
        $statement->bindValue(':lastName', $ticket->lastName);
        $statement->bindValue(':phoneNumber', $ticket->phoneNumber);
        $statement->bindValue(':device', $ticket->device);
        $statement->bindValue(':status', $ticket->status);
        $statement->bindValue(':quotedPrice', $ticket->quotedPrice);
        $statement->bindValue(':body', $ticket->body);
        $statement->bindValue(':location', $ticket->location);
        $statement->bindValue(':id', $ticket->id);
        $statement->execute();
    }

    public function deleteTicket($id)
    // Delete Ticket
    {
        $statement = $this->pdo->prepare('DELETE FROM ticket WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
}
