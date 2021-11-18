<?php

namespace app\controllers;
// Imports
use app\models\Ticket;
use app\models\Note;
use app\Router;

class TicketController
{
    // Get Tickets and Search Data for Future version
    // Will link to Charts
    public static function dashboard(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $tickets = $router->db->getTickets($search);
        $router->renderView('dashboard/index', [
            'tickets' => $tickets,
            'search' => $search
        ]);
    }

    public static function index(Router $router)
    {
        // Get all tickets and search filter
        $search = $_GET['search'] ?? '';
        $tickets = $router->db->getTickets($search);
        $router->renderView('tickets/index', [
            'tickets' => $tickets,
            'search' => $search
        ]);
    }

    public static function view(Router $router)
    {
        // If no id found. go back else get ticket
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /tickets');
            exit;
        }
        // Get tickets and notes by ID
        $ticket = $router->db->getTicketById($id);
        $notes = $router->db->getNotebyId($id);
        // Import view and Params
        $router->renderView('tickets/view', [
            'ticket' => $ticket,
            'notes' => $notes,
        ]);
        // Note creation

        // Error and Data Array
        $errors = [];
        $noteData = [
            'ticket_id' => '',
            'body' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Link form data and varibles
            $noteData['body'] = $_POST['body'];
            $noteData['ticket_id'] = $id;

            // Create note
            $note = new Note();
            // load note data to object
            $note->load($noteData);
            // check for errors and save to db
            $errors = $note->save();
            // if no errors, redirect back and complete save
            if (empty($errors)) {
                header("Location: /tickets/view?id=$id");
                exit;
            }
        }
        // if errors, show errors
        $router->renderView('tickets/view', [
            'note' => $noteData,
            'errors' => $errors
        ]);
    }

    public static function create(Router $router)
    {
        // Error and Data Array
        $errors = [];
        $ticketData = [
            'title' => '',
            'body' => '',
            'bookedBy' => '',
            'firstName' => '',
            'lastName' => '',
            'phoneNumber' => '',
            'device' => '',
            'quotedPrice' => '',
            'location' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Link form data and varibles
            $ticketData['title'] = $_POST['title'];
            $ticketData['body'] = $_POST['body'];
            $ticketData['bookedBy'] = $_POST['bookedBy'];
            $ticketData['firstName'] = $_POST['firstName'];
            $ticketData['lastName'] = $_POST['lastName'];
            $ticketData['phoneNumber'] = $_POST['phoneNumber'];
            $ticketData['device'] = $_POST['device'];
            $ticketData['quotedPrice'] = (float)$_POST['quotedPrice'];
            $ticketData['location'] = $_POST['location'];
            $ticketData['status'] = $_POST['status'];

            // Create ticket
            $ticket = new Ticket();
            // load ticket data to object
            $ticket->load($ticketData);
            // check for errors and save to db
            $errors = $ticket->save();
            // if no errors, redirect back and complete save
            if (empty($errors)) {
                header('Location: /tickets');
                exit;
            }
        }
        // if errors, show errors
        $router->renderView('tickets/create', [
            'ticket' => $ticketData,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        // If no id found. go back else get ticket
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /tickets');
            exit;
        }
        // Error and Data Array
        $errors = [];
        $ticketData = $router->db->getTicketById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Link form data and varibles
            $ticketData['title'] = $_POST['title'];
            $ticketData['body'] = $_POST['body'];
            $ticketData['bookedBy'] = $_POST['bookedBy'];
            $ticketData['firstName'] = $_POST['firstName'];
            $ticketData['lastName'] = $_POST['lastName'];
            $ticketData['phoneNumber'] = $_POST['phoneNumber'];
            $ticketData['device'] = $_POST['device'];
            $ticketData['quotedPrice'] = (float)$_POST['quotedPrice'];
            $ticketData['location'] = $_POST['location'];
            $ticketData['status'] = $_POST['status'];

            // Create ticket
            $ticket = new Ticket();
            // load ticket data to object
            $ticket->load($ticketData);
            // check for errors and save to db
            $errors = $ticket->save();
            // check for errors and save to db
            if (empty($errors)) {
                // if no errors, redirect back and complete save
                header('Location: /tickets');
                exit;
            }
        }
        // if errors, show errors
        $router->renderView('tickets/update', [
            'ticket' => $ticketData,
            'errors' => $errors
        ]);
    }

    public static function delete(Router $router)
    {
        // If no id found. go back else get ticket
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /tickets');
            exit;
        }
        // Delete ticket and redirect
        $router->db->deleteTicket($id);
        header('Location: /tickets');
    }
}
