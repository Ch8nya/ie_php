<?php
session_start();

$response = array(
    'moduleNumber' => isset($_SESSION['moduleNumber']) ? $_SESSION['moduleNumber'] : null,
    'lessonNumber' => isset($_SESSION['lessonNumber']) ? $_SESSION['lessonNumber'] : null,
);

echo json_encode($response);
?>
