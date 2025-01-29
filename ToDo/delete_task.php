<?php
require_once 'config.php';

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    $stmt = $db->prepare("DELETE FROM `task` WHERE `task_id` = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting task.";
    }
} else {
    echo "Invalid request: No task ID received.";
}
?>
