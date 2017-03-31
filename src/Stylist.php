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

        // function delete()
        // {
        //     $executed = $GLOBALS['DB']->exec("DELETE FROM categories WHERE id = {$this->getId()};");
        //      if (!$executed) {
        //          return false;
        //      }
        //      $executed = $GLOBALS['DB']->exec("DELETE FROM tasks WHERE category_id = {$this->getId()};");
        //      if (!$executed) {
        //          return false;
        //      } else {
        //          return true;
        //      }
        // }
        //
        // function getTasks()
        // {
        //     $tasks = Array();
        //     $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks WHERE category_id = {$this->getId()};");
        //     foreach($returned_tasks as $task) {
        //         $description = $task['description'];
        //         $task_id = $task['id'];
        //         $category_id = $task['category_id'];
        //         $new_task = new Task($description, $category_id, $task_id);
        //         array_push($tasks, $new_task);
        //     }
        //     return $tasks;
        // }
        //
        // static function getAll()
        // {
        //     $returned_categories = $GLOBALS['DB']->query("SELECT * FROM categories;");
        //     $categories = array();
        //     foreach($returned_categories as $category) {
        //         $name = $category['name'];
        //         $id = $category['id'];
        //         $new_category = new Category($name, $id);
        //         array_push($categories, $new_category);
        //     }
        //     return $categories;
        // }
        //
        // static function deleteAll()
        // {
        //   $GLOBALS['DB']->exec("DELETE FROM categories;");
        // }
        //
        // function update($new_name)
        // {
        //     $executed = $GLOBALS['DB']->exec("UPDATE categories SET name = '{$new_name}' WHERE id = {$this->getId()};");
        //     if ($executed) {
        //        $this->setName($new_name);
        //        return true;
        //     } else {
        //        return false;
        //     }
        // }
        //
        // static function find($search_id)
        // {
        //     $found_category = null;
        //     $returned_categories = $GLOBALS['DB']->prepare("SELECT * FROM categories WHERE id = :id");
        //     $returned_categories->bindParam(':id', $search_id, PDO::PARAM_STR);
        //     $returned_categories->execute();
        //     foreach($returned_categories as $category) {
        //         $category_name = $category['name'];
        //         $category_id = $category['id'];
        //         if ($category_id == $search_id) {
        //           $found_category = new Category($category_name, $category_id);
        //         }
        //     }
        //     return $found_category;
        // }
    }
?>
