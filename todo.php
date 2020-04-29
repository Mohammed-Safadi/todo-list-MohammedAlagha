<?php
$db = new mysqli('localhost', 'root', '', 'todo-palLancer');

if (!$db) {
     die('connot connent to database!');
}
if ($_POST && strlen($_POST['content']) != 0) {
     $sql = 'INSERT INTO todos (content) VALUES (?)';

     $stmt = $db->prepare($sql);
     $stmt->bind_param('s', $_POST['content']);

     if ($stmt->execute()) {
     };
     $_POST['content'] = '';
}

if (isset($_GET['id'])) {
     $sql = 'UPDATE todos SET completed = 1 WHERE id = ?';
     $stmt = $db->prepare($sql);
     $stmt->bind_param('i',$_GET['id']);
     $stmt->execute();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
     $sql = 'DELETE FROM todos WHERE id = ?';
     $stmt = $db->prepare($sql);
     $stmt->bind_param('i',$_GET['id']);
     $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style/main.css">

     <script src="js/jquery-3.5.0.min.js"></script>
     <script src="js/main.js"></script>
     <title>Todo List</title>
</head>

<body>
     <div class="container">
          <h1>Todo List</h1>
          <div class="todo">
               <form action="todo.php" method="POST">
                    <div class="add-form">
                         <input type="text" name="content" id="text-input" placeholder="Type a todo" va>
                         <button type="submit" class="add-button" id="add-button">Add</button>
                    </div>
               </form>
               <div class="list">
                    <ul id="todo-ul">
                         <!-- <li>Task 1 
                         <button class="delete"> Delete </button> 
                         <button class="done">Make as Done</button>
                         </li> -->
                         <?php
                         $sql = 'SELECT * FROM todos ORDER BY id DESC';
                         $result = $db->query($sql);
                         while (($row = $result->fetch_assoc()) != false) :
                         ?>
                              <li <?php if($row['completed'] == 1): ?>
                                    style='color:darkgreen' <?php endif ?> 
                                    >
                                    <?= $row['content'] ?>

                                   <a href="todo.php?action=delete&id=<?= $row['id'] ?>" class="delete"> Delete </a>
                                   
                                   <?php if($row['completed'] == 0) : ?>
                                        <a href="todo.php?id=<?= $row['id'] ?>" class="done">Make as Done</a>
                                   <?php endif ?>
                              </li>
                         <?php endwhile ?>
                    </ul>
               </div>
          </div>
     </div>



</body>

</html>