<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT buy_status, score FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$buy_status = $row['buy_status'];
$existing_score = $row['score'];

if ($buy_status != 1) {
    header("Location: buy.php");
    exit();
}

if ($existing_score !== null) {
    // User has already taken the test, redirect to apply.php
    header("Location: apply.php");
    exit();
}

$grand_total_marks = null;

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

   $random_number = 0;
   if (!empty($_POST['q14']) && !empty($_POST['q15'])) {
       $random_number = rand(4, 6);
   }

   $grand_total_marks = $total_marks + $random_number;

   // Update the score in the database
    $update_score_sql = "UPDATE users SET score = $grand_total_marks WHERE id = $user_id";
    if ($conn->query($update_score_sql) === TRUE) {
        // Output the grand total marks as a JSON response
        echo json_encode(['score' => $grand_total_marks, 'redirect' => true]);
    } else {
        echo "Error updating score: " . $conn->error;
    }

    exit();
}
?>

   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <style>
        /* Center the container */
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
            max-height: 80vh; /* Add this line */
            overflow-y: auto; /* Add this line */
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

       #score {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 600px) {
            .test-container {
                padding: 10px;
            }

            .question label {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>Certification Test</h1>
        <form action="#" method="post">
            <div class="question">
                <label>1. Which of the following is NOT one of the five phases of the design thinking process?</label><br>
                <input type="radio" name="q1" value="a"> a) Empathize<br>
                <input type="radio" name="q1" value="b"> b) Define<br>
                <input type="radio" name="q1" value="c"> c) Ideate<br>
                <input type="radio" name="q1" value="d"> d) Implement<br>
            </div>

            <div class="question">
                <label>2. What is the primary goal of the evaluation phase in the user-centered design process?</label><br>
                <input type="radio" name="q2" value="a"> a) To determine how well the design meets user requirements<br>
                <input type="radio" name="q2" value="b"> b) To identify potential areas for improvement<br>
                <input type="radio" name="q2" value="c"> c) To gather feedback from users for future iterations<br>
                <input type="radio" name="q2" value="d"> d) All of the above<br>
            </div>

            <div class="question">
                <label>3. What is the primary purpose of a customer journey map?</label><br>
                <input type="radio" name="q3" value="a"> a) To visualize a user's goals and actions with a product or service<br>
                <input type="radio" name="q3" value="b"> b) To track a company's sales and marketing efforts<br>
                <input type="radio" name="q3" value="c"> c) To document the development process of a new product<br>
                <input type="radio" name="q3" value="d"> d) To outline the organizational structure of a business<br>
            </div>

            <div class="question">
                <label>4. Which of the following accurately describes the process of tree testing?</label><br>
                <input type="radio" name="q4" value="a"> a) Participants organize cards into groups based on predefined criteria.<br>
                <input type="radio" name="q4" value="b"> b) Participants navigate through a simplified, text-based outline of a site's content structure.<br>
                <input type="radio" name="q4" value="c"> c) Participants physically or digitally arrange a set of labeled cards into groups.<br>
                <input type="radio" name="q4" value="d"> d) Participants evaluate the usability of a fully designed website prototype.<br>
            </div>

            <div class="question">
                <label>5. Which of the following is a tip for creating a sitemap for a large-sized website?</label><br>
                <input type="radio" name="q5" value="a"> a) Use a mega menu for improved scanning<br>
                <input type="radio" name="q5" value="b"> b) Create a flat sitemap with fewer vertical levels<br>
                <input type="radio" name="q5" value="c"> c) Opt for a deep sitemap with limited vertical levels<br>
                <input type="radio" name="q5" value="d"> d) Focus on creating a horizontal navigation structure<br>
            </div>

            <div class="question">
                <label>6. Which component is typically represented in a wireframe by a rectangle with an X?</label><br>
                <input type="radio" name="q6" value="a"> a) Buttons<br>
                <input type="radio" name="q6" value="b"> b) Images<br>
                <input type="radio" name="q6" value="c"> c) Dropdowns<br>
                <input type="radio" name="q6" value="d"> d) Body text<br>
            </div>

            <div class="question">
                <label>7. What distinguishes a low-fidelity prototype from a high-fidelity one?</label><br>
                <input type="radio" name="q7" value="a"> a) Low-fidelity prototypes have complex interactions and animations.<br>
                <input type="radio" name="q7" value="b"> b) High-fidelity prototypes include rough whiteboard sketches.<br>
                <input type="radio" name="q7" value="c"> c) Low-fidelity prototypes lack visual design details and real content.<br>
                <input type="radio" name="q7" value="d"> d) High-fidelity prototypes are created early in the design process.<br>
            </div>

            <div class="question">
                <label>8. Which color harmony creates low color contrast by using colors next to each other on the color wheel?</label><br>
                <input type="radio" name="q8" value="a"> a) Complementary<br>
                <input type="radio" name="q8" value="b"> b) Monochromatic<br>
                <input type="radio" name="q8" value="c"> c) Split-complementary<br>
                <input type="radio" name="q8" value="d"> d) Analogous<br>
            </div>

            <div class="question">
                <label>9. What aspect of typography helps to optimize the space between letters and lines, ensuring text readability?</label><br>
                <input type="radio" name="q9" value="a"> a) Font Weight<br>
                <input type="radio" name="q9" value="b"> b) Baseline<br>
                <input type="radio" name="q9" value="c"> c) Kerning and Leading<br>
                <input type="radio" name="q9" value="d"> d) Font Size<br>
            </div>

            <div class="question">
                <label>10. What is the mobile-first approach in responsive web design?</label><br>
                <input type="radio" name="q10 value="a"> a) Designing for desktop first and then scaling down for mobile<br>
                <input type="radio" name="q10" value="b"> b) Prioritizing content and functionality for smaller screens first<br>
                <input type="radio" name="q10" value="c"> c) Focusing solely on designing for tablet devices<br>
                <input type="radio" name="q10" value="d"> d) Creating separate websites for mobile and desktop users<br>
            </div>

            <div class="question">
                <label>11. Which type of dashboard is designed for time-sensitive tasks like monitoring server availability?</label><br>
                <input type="radio" name="q11" value="a"> a) Analytical Dashboards<br>
                <input type="radio" name="q11" value="b"> b) Operational Dashboards<br>
                <input type="radio" name="q11" value="c"> c) Interactive Dashboards<br>
                <input type="radio" name="q11" value="d"> d) Static Dashboards<br>
            </div>

            <div class="question">
                <label>12. How does Atomic Design facilitate prototyping?</label><br>
                <input type="radio" name="q12" value="a"> a) By creating complex organisms directly<br>
                <input type="radio" name="q12" value="b"> b) By focusing only on page-level design<br>
                <input type="radio" name="q12" value="c"> c) By providing a list of atoms for easy selection and combination<br>
                <input type="radio" name="q12" value="d"> d) By skipping the stages of molecules and organisms<br>
            </div>

            <div class="question">
                <label>13. What advantage does Atomic Design offer in terms of updating and removal of components?</label><br>
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
           
    <h2 id="score"></h2>
            <button onclick="window.location='apply.php'">Apply for Internship</button>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            const formData = new FormData(this);
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Display the score on the current page
                document.getElementById('score').textContent = 'Your score: ' + data.score;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
