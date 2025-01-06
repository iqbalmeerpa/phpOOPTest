<?php 
include("../../headers/header.php");
include_once("../../controller/TodoController.php");


$todos = new TodoController();
$todo = $todos->edit_todo($_GET['id']);

if (!$todo) {
    echo "Todo not found!";
    exit;
}

$due_date = date('Y-m-d', strtotime($todo['due_date']));
?>

<style>
    .card {
        margin: 20px 0;
    }
    .areatext {
        resize: none;
        width: 100%;
        height: 110px;
    }
    .bck-btn {
        margin: 30px 0;
    }
</style>

<div class="container">
    <a href="index.php"><button class="btn btn-primary bck-btn">Back</button></a>
    <div class="card">
        <div class="card-header">
            Update Todo
        </div>
        <div class="card-body">

            <?php 
            if (isset($_POST['todo_update'])) {
                $id = $_GET['id'];
                $todo = $_POST['todo'];
                $priority = $_POST['priority'];
                $status = $_POST['status'];

                $update_todo = new TodoController();
                $result = $update_todo->update_todo($id, $todo, $priority, $status);

                if ($result) {
                    echo "<div class='alert alert-success'>Todo updated successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Failed to update Todo.</div>";
                }
            }
            ?>

            <form action="" method="POST">
                <label for="Todo">Todo : </label>
                <input type="text" name="todo" value="<?= htmlspecialchars($todo['details']) ?>" id="" class="form-control" required>
                <br>

                <label for="due_date">Due Date: </label>
                <input type="date" name="due_date" id="due_date" value="<?= $due_date ?>" class="form-control" readonly>
                <br>

                <label for="priority">Priority: </label><br>
                <input type="radio" name="priority" value="high" id="priority_high" <?= $todo['priority'] === 'high' ? 'checked' : '' ?>> High<br>
                <input type="radio" name="priority" value="medium" id="priority_medium" <?= $todo['priority'] === 'medium' ? 'checked' : '' ?>> Medium<br>
                <input type="radio" name="priority" value="normal" id="priority_normal" <?= $todo['priority'] === 'normal' ? 'checked' : '' ?>> Normal<br>
                <br>

                <label for="status">Status: </label><br>
                <input type="radio" name="status" value="pending" id="status_pending" <?= $todo['todo_status'] === 'pending' ? 'checked' : '' ?>> Pending<br>
                <input type="radio" name="status" value="done" id="status_done" <?= $todo['todo_status'] === 'done' ? 'checked' : '' ?>> Done<br>
                <input type="radio" name="status" value="in_progress" id="status_in_progress" <?= $todo['todo_status'] === 'in_progress' ? 'checked' : '' ?>> In Progress<br>
                <input type="radio" name="status" value="paused" id="status_paused" <?= $todo['todo_status'] === 'paused' ? 'checked' : '' ?>> Paused<br>
                <br>

                <label for="is_active">Active: </label>
                <input type="checkbox" name="is_active" id="is_active" <?= $todo['is_active'] == 1 ? 'checked' : '' ?>>
                <br><br>

                <input type="submit" value="Update Todo" name="todo_update" class="btn btn-success">
            </form>
        </div>
    </div>
</div>
