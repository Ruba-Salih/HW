<?php
/* 
    FileName: view_tasks.php
    Author: Raghad
    CreationDate: 17/07/24
    Purpose: This file is responsible for displaying and managing tasks. It includes functionalities 
             to view, update, and delete tasks. It interacts with the TaskController to perform these actions.
*/

session_start(); // Start a session to manage user authentication
if (!isset($_SESSION['user_id'])) { // Check if the user is logged in
    header("Location: index.php?action=login"); // Redirect to login page if not logged in
    exit();
}

require_once 'controllers/TaskController.php'; // Include the TaskController to manage tasks

$taskController = new TaskController(); // Instantiate the TaskController
$message = ''; // Initialize a message variable to store status messages

// Handle updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    if ($taskController->update()) { // Attempt to update the task
        $message = "Task updated successfully."; // Success message
    } else {
        $message = "Task updated successfully."; // Failure message
    }
}

// Handle deletions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    if ($taskController->delete()) { // Attempt to delete the task
        $message = "Task deleted successfully."; // Success message
    } else {
        $message = "Task deleted successfully."; // Failure message
    }
}

$tasks_arr = json_decode($taskController->read(), true); // Decode JSON string to array to get the tasks

include 'header.php'; // Include the header file
?>
<div class="container">
    <h2>Your Tasks</h2>
    <button class="back-button" onclick="history.back()">Go Back</button>
    <a href="dashboard.php" class="back-button">Go Back to Dashboard</a>

    
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p> <!-- Display the status message -->
    <?php endif; ?>
    
    <ul class="tasks">
        <?php if (empty($tasks_arr['data'])): ?>
            <li>No tasks found.</li> <!-- Message displayed when no tasks are found -->
        <?php else: ?>
            <?php foreach ($tasks_arr['data'] as $task): ?>
                <li class="<?php echo $task['status'] == 'completed' ? 'completed' : ''; ?>">
                    <strong><?php echo htmlspecialchars($task['title']); ?></strong><br>
                    <?php echo htmlspecialchars($task['description']); ?><br>
                    Due: <?php echo htmlspecialchars($task['due_date']); ?><br>
                    Category: <?php echo htmlspecialchars($task['category']); ?><br>
                    Status: <?php echo htmlspecialchars($task['status']); ?><br>
                    
                    <!-- Update form -->
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <input type="hidden" name="title" value="<?php echo $task['title']; ?>">
                        <input type="hidden" name="description" value="<?php echo $task['description']; ?>">
                        <input type="hidden" name="due_date" value="<?php echo $task['due_date']; ?>">
                        <input type="hidden" name="category" value="<?php echo $task['category']; ?>">
                        <input type="hidden" name="action" value="update">
                        <label for="status">Status:</label>
                        <select id="status" name="status" required>
                            <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                        </select>
                        <button type="submit">Update</button> <!-- Button to submit the update form -->
                    </form>
                    
                    <!-- Delete form -->
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit">Delete</button> <!-- Button to submit the delete form -->
                    </form>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
<?php include 'footer.php'; // Include the footer file ?>
