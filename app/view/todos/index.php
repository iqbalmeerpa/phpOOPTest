<?php
include("../../headers/header.php");
include_once("../../controller/TodoController.php");
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
</style>

<div class="container">

    <div class="card">
        <div class="card-header">Add Todo</div>
        <div class="card-body">
            <?php
            if (isset($_POST['add_todo'])) {
                // Sanitize input data
                $todo = htmlspecialchars($_POST['todo']);
                $due_date = htmlspecialchars($_POST['due_date']);
                $priority = htmlspecialchars($_POST['priority']);
                $status = htmlspecialchars($_POST['status']);
                $is_active = isset($_POST['is_active']) ? 1 : 0;

                $add_todo = new TodoController();
                $add_todo->add_todo($todo, $due_date, $priority, $status, $is_active);
            }
            ?>

            <form action="" method="POST">
                <label for="todo">Todo: </label>
                <input type="text" name="todo" id="todo" class="form-control" required><br>

                <label for="due_date">Due Date: </label>
                <input type="date" name="due_date" id="due_date" class="form-control"><br>

                <label for="priority">Priority: </label><br>
                <input type="radio" name="priority" value="high" id="priority_high"> High<br>
                <input type="radio" name="priority" value="medium" id="priority_medium"> Medium<br>
                <input type="radio" name="priority" value="normal" id="priority_normal"> Normal<br><br>

                <label for="status">Status: </label><br>
                <input type="radio" name="status" value="pending" id="status_pending"> Pending<br>
                <input type="radio" name="status" value="done" id="status_done"> Done<br>
                <input type="radio" name="status" value="in_progress" id="status_in_progress"> In Progress<br>
                <input type="radio" name="status" value="paused" id="status_paused"> Paused<br><br>

                <label for="is_active">Active: </label>
                <input type="checkbox" name="is_active" id="is_active"><br><br>

                <input type="submit" value="Add Todo" name="add_todo" class="btn btn-success">
            </form>
        </div>
    </div>

    <hr>

    <h2 class="text-center">All Todos</h2>

    <?php
    if (isset($_POST['delete_todo'])) {
        $id = htmlspecialchars($_POST['delete_id']);

        $delete_todo = new TodoController();
        $delete_todo->delete_todo($id);
    }
    ?>

    <ol class="list-group">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Todo</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Active</th>
                    <th>Added Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todos = new TodoController();
                $all_todos = $todos->view_todos();

                foreach ($all_todos as $todo) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($todo['id']); ?></td>
                        <td><?= htmlspecialchars($todo['details']); ?></td>
                        <td><?= htmlspecialchars($todo['priority']); ?></td>
                        <td><?= htmlspecialchars($todo['todo_status']); ?></td>
                        <td><?= $todo['is_active'] ? 'Yes' : 'No'; ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($todo['created_at']))); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($todo['due_date']))); ?></td>
                        <td>
                            <a href="show.php?id=<?= htmlspecialchars($todo['id']); ?>">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-eye"></i> Show
                                </button>
                            </a>
                            <a href="edit.php?id=<?= htmlspecialchars($todo['id']); ?>">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </a>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($todo['id']); ?>">
                                <button type="submit" name="delete_todo" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </ol>
</div>