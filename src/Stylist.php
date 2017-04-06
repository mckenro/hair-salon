<?php
    class Stylist
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}')");
            if ($executed) {
                 $this->id= $GLOBALS['DB']->lastInsertId();
                 return true;
            } else {
                 return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
             if (!$executed) {
                 return false;
             }
             $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
             if (!$executed) {
                 return false;
             } else {
                 return true;
             }
        }

        function getClients()
        {
            $clients = Array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach($returned_clients as $client) {
                $client_name = $client['client_name'];
                $client_id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($client_name, $stylist_id, $client_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        function update($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
               $this->setName($new_name);
               return true;
            } else {
               return false;
            }
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $returned_stylists = $GLOBALS['DB']->prepare("SELECT * FROM stylists WHERE id = :id");
            $returned_stylists->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_stylists->execute();
            foreach($returned_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $stylist_id = $stylist['id'];
                if ($stylist_id == $search_id) {
                  $found_stylist = new Stylist($stylist_name, $stylist_id);
                  return $found_stylist;
                }
            }
        }

    }
?>
