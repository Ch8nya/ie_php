<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT buy_status FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$buy_status = $row['buy_status'];

if ($buy_status != 1) {
    header("Location: buy.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correct_answers = [
        1 => 'd',
        2 => 'd',
        3 => 'a',
        4 => 'b',
        5 => 'b',
        6 => 'b',
        7 => 'c',
        8 => 'd',
        9 => 'c',
        10 => 'b',
        11 => 'b',
        12 => 'c',
        13 => 'a'
    ];

    $total_marks = 0;
    foreach ($correct_answers as $question => $correct_answer) {
        if (isset($_POST["q$question"]) && $_POST["q$question"] == $correct_answer) {
            $total_marks += 4;
        }
    }

    $random_number = rand(4, 6);
    $grand_total_marks = $total_marks + $random_number;

    echo "<h2>Your Grand Total Marks: $grand_total_marks / 60</h2>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .test-container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 80vh;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .question {
            margin-bottom: 30px;
        }

        .question label {
            display: block;
            text-align: left;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .question input[type="radio"] {
            margin-right: 10px;
        }

        .question textarea {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        button[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>Test</h1>
        <form method="post" action="">
            <div class="question">
                <label for="q1">1. What is the role of a user journey map?</label><br>
                <input type="radio" name="q1" value="a"> a) Design<br>
                <input type="radio" name="q1" value="b"> b) Evaluate<br>
                <input type="radio" name="q1" value="c"> c) Ideate<br>
                <input type="radio" name="q1" value="d"> d) Implement<br>
            </div>
            <!-- Add other questions similarly -->
            <div class="question">
                <label for="q13">13. What is the main benefit of using atomic design principles in a design system?</label><br>
                <input type="radio" name="q13" value="a"> a) Changes are propagated across the site automatically<br>
                <input type="radio" name="q13" value="b"> b) Only one component is altered at a time, making updates easy<br>
                <input type="radio" name="q13" value="c"> c) Unwanted components cannot be removed easily<br>
                <input type="radio" name="q13" value="d"> d) Components are tightly coupled, making updates challenging<br>
            </div>

            <div class="question">
                <label for="q14">14. You have been tasked with redesigning the user experience for a popular mobile banking app. The current app has received numerous complaints from users about confusing navigation, cluttered layouts, and a lack of consistency across different sections of the app.
                How would you approach this redesign project using the principles of user-centered design and design thinking? Describe the specific steps you would take, the research methods you would employ, and the key considerations you would keep in mind throughout the process.</label><br>
                <textarea name="q14" id="q14" rows="5" cols="80"></textarea>
            </div>

            <div class="question">
                <label for="q15">15. You have been asked to create a customer journey map for a popular e-commerce website that sells a wide range of products. The goal is to identify pain points and opportunities for improving the overall customer experience, from initial awareness to post-purchase support.
                Describe the steps you would take to create a comprehensive customer journey map, including the research methods you would use, the key elements you would include, and how you would visualize and present the map to stakeholders.</label><br>
                <textarea name="q15" id="q15" rows="5" cols="80"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
