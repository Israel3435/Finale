<!DOCTYPE html>
<html lang="en">
<head>
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <nav>
        <a class="heading" href="#">ToDo App</a>
    </nav>
    <div class="container">
        <div class="input-area">
            <form method="POST" action="add_task.php">
                <input type="text" name="task" placeholder="Write your tasks here..." required />
                <button class="btn" name="add">Add Task</button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tasks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config.php';
                $fetchingtasks = mysqli_query($db, "SELECT * FROM `task` ORDER BY `task_id` ASC") or die(mysqli_error($db));
                $count = 1;
                while ($fetch = $fetchingtasks->fetch_array()) {
                ?>
                    <tr class="border-bottom">
                        <td><?= $count++ ?></td>
                        <td><?= htmlspecialchars($fetch['task']); ?></td>
                        <td><?= $fetch['status']; ?></td>
                        <td class="action">
                            <?php if ($fetch['status'] != "Done") { ?>
                                <form method="POST" action="update_task.php" style="display:inline;">
                                    <input type="hidden" name="task_id" value="<?= $fetch['task_id']; ?>">
                                    <button type="submit" class="btn-completed">✅ Mark as Done</button>
                                </form>
                            <?php } ?>
                            <form method="POST" action="delete_task.php" style="display:inline;">
                                <input type="hidden" name="task_id" value="<?= $fetch['task_id']; ?>">
                                <button type="submit" class="btn-remove">❌ Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
