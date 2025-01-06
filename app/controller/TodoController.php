<?php 
    include_once("../../model/TodoModel.php");

    class TodoController extends TodoModel {
        public function view_todos(){
            return $this->all_todos();
        }

        public function add_todo($todo, $due_date,$priority,$status,$is_active){
            return $this->todo_add($todo, $due_date,$priority,$status,$is_active);
        }

        public function edit_todo($id){
            return $this->todo_edit($id);
        }

        public function update_todo($id, $todo,  $priority, $status){
            return $this->todo_update($id, $todo, $priority, $status);
        }

        public function delete_todo($id){
            return $this->todo_delete($id);
        }
    }
?>