<?php
class Client
{
    private $client_name;
    private $stylist_id;
    private $id;

    function __construct($client_name, $assigned_stylist_id, $id = null)
    {
        $this->client_name = $client_name;
        $this->stylist_id = $assigned_stylist_id;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->client_name;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function setName($new_name)
    {
        $this->client_name = (string) $new_name;
    }

    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = (int) $new_stylist_id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()})");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
        $clients = array();
        foreach($returned_clients as $client) {
            $client_name = $client['client_name'];
            $id = $client['id'];
            $stylist_id = $client['stylist_id'];
            $new_client = new Client($client_name, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    static function deleteAll()
    {
      $executed = $GLOBALS['DB']->exec("DELETE FROM clients;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    function update($new_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE clients SET client_name = '{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
           $this->setName($new_name);
           return true;
        } else {
           return false;
        }
    }

    static function find($search_id)
    {
        $found_client = null;
        $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id");
        $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_clients->execute();
        foreach($returned_clients as $client) {
            $client_name = $client['client_name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            if ($id == $search_id) {
              $found_client = new Client($client_name, $stylist_id, $id);
            }
        }
        return $found_client;
    }
}
?>
