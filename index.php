<?php
session_start();

// Array to store the modules and lessons
$modules = [
  [
    'name' => 'Module 1',
    'lessons' => [
      'Content for Module 1 Lesson 1',
      'Content for Module 1 Lesson 2',
      'Content for Module 1 Lesson 3',
    ],
  ],
  [
    'name' => 'Module 2',
    'lessons' => [
      'Content for Module 2 Lesson 1',
      'Content for Module 2 Lesson 2',
      'Content for Module 2 Lesson 3',
      'Content for Module 2 Lesson 4',
    ],
  ],
  // Add more modules and lessons as needed
];

// Check if the user's progress exists in the session
if (!isset($_SESSION['progress'])) {
  $_SESSION['progress'] = [
    'module' => 0,
    'lesson' => 0,
  ];
}

// Handle the next button click
if (isset($_POST['next'])) {
  $_SESSION['progress']['lesson']++;
  if ($_SESSION['progress']['lesson'] >= count($modules[$_SESSION['progress']['module']]['lessons'])) {
    $_SESSION['progress']['lesson'] = 0;
    $_SESSION['progress']['module']++;
    if ($_SESSION['progress']['module'] >= count($modules)) {
      $_SESSION['progress']['module'] = 0; // Reset to the first module if reached the end
    }
  }
}

$currentModule = $_SESSION['progress']['module'];
$currentLesson = $_SESSION['progress']['lesson'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dynamic Content Loading</title>
</head>
<body>
  <h1>Dynamic Content Loading</h1>
  
  <div id="content">
    <h2><?php echo $modules[$currentModule]['name']; ?></h2>
    <p><?php echo $modules[$currentModule]['lessons'][$currentLesson]; ?></p>
  </div>
  
  <form method="post">
    <button type="submit" name="next">Next</button>
  </form>
</body>
</html>
