<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    $task = trim($_POST['task']); // Remove spaces

    if (!empty($task)) {
        $stmt = $db->prepare("INSERT INTO `task` (`task`, `status`) VALUES (?, 'Pending')");
        $stmt->bind_param("s", $task);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error adding task.";
        }
    } else {
        echo "Task cannot be empty!";
    }
}
?>
