<?php
$conn = new mysqli('localhost', 'root', 'Rocky@123', 'todolist');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $conn->query($sql);
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Edit Task</h1>
    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo $task['title']; ?>" required><br><br>
        <label>Description:</label><br>
        <textarea name="description" required><?php echo $task['description']; ?></textarea><br><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="Pending" <?php if ($task['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Completed" <?php if ($task['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
        </select><br><br>
        <input type="submit" value="Update Task">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>

