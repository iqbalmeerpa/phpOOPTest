<?php

include("../../config/database.php");

class TodoModel extends db
{
    public function todo_add($todo, $due_date, $priority, $status, $is_active)
    {
        try {
            $sql = "INSERT INTO tasks(details, due_date, priority, todo_status, is_active) VALUES (?, ?, ?, ?, ?)";
            $sql_exc = $this->connect()->prepare($sql);
            $success = $sql_exc->execute([$todo, $due_date, $priority, $status, $is_active]);
            if ($success) {
                echo "Todo added successfully!";
            } else {
                echo "Failed to add Todo.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function all_todos()
    {
        $sql = "SELECT * FROM tasks";
        $sql_exc = $this->connect()->prepare($sql);
        $sql_exc->execute();
        $result = $sql_exc->fetchAll();

        return $result;
    }

    public function todo_edit($id)
    {
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $sql_exc = $this->connect()->prepare($sql);
        $sql_exc->execute([$id]);
        $result = $sql_exc->fetch();

        return $result;
    }

    public function todo_update($id, $todo, $priority, $status)
    {
        try {
            $sql = "UPDATE tasks SET details = ?, priority = ?, todo_status = ? WHERE id = ?";
            $sql_exc = $this->connect()->prepare($sql);

            $result = $sql_exc->execute([$todo, $priority, $status, $id]);

            if ($result) {
                echo "Todo updated successfully!";
            } else {
                echo "Failed to update Todo.";
            }

            header("location:index.php");
            exit; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function todo_delete($id)
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $sql_exc = $this->connect()->prepare($sql);
        $result = $sql_exc->execute([$id]);

        return $result;
    }
}
