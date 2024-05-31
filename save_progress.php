<?php
session_start();
require_once 'config.php'; // Your database connection file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate the input
    if (isset($input['moduleNumber']) && isset($input['lessonNumber'])) {
        $moduleNumber = intval($input['moduleNumber']);
        $lessonNumber = intval($input['lessonNumber']);

        // Get the current user's ID (assuming you have user authentication)
        $userId = $_SESSION['user_id'];

        // Fetch the current progress
        $query = "SELECT moduleNumber, lessonNumber FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($currentModuleNumber, $currentLessonNumber);
        $stmt->fetch();
        $stmt->close();

        // Check if the new progress is greater
        if ($moduleNumber > $currentModuleNumber || ($moduleNumber === $currentModuleNumber && $lessonNumber > $currentLessonNumber)) {
            // Update the user's progress in the database
            $query = "UPDATE users SET moduleNumber = ?, lessonNumber = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iii', $moduleNumber, $lessonNumber, $userId);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update progress']);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'skipped', 'message' => 'New progress is not greater than current progress']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
