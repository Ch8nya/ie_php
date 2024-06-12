<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the score is null
$sql = "SELECT score FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($score);
    $stmt->fetch();
    $stmt->close();

    if (is_null($score)) {
        echo "<script>
            alert('Give the assessment test first.');
            window.location.href = 'test.php';
        </script>";
        exit();
    }
} else {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Fetch the projectNo from the database
$sql = "SELECT projectNo FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($projectNo);
    $stmt->fetch();
    $stmt->close();

    if ($projectNo !== NULL) {
        echo "<script>
            alert('You have already applied to the internship. Please complete and mail the assigned work.');
            window.location.href = 'learn.php';
        </script>";
        exit();
    }
} else {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['projectNo'])) {
    $projectNo = $_POST['projectNo'];

    // Update the projectNo in the database
    $sql = "UPDATE users SET projectNo = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $projectNo, $user_id);
        if ($stmt->execute()) {
            echo "Project number updated successfully.";
        } else {
            echo "Error updating project number: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
    exit();
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Listings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
            margin: 0;
            background-color: #eff0e9;
                        
        }

        h1, h2 {
            font-family: 'Montserrat', sans-serif;
        }

        h1 {
            margin-bottom: 20px;
            color: black;
            font-size: 60px;
        }
        h2{
            font-size: 30px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
            color: black;
            font-family: 'Inter', sans-serif;
        }
        th {
            background-color: #2d2f31;
            color: white;
            border: 1px solid white; /* Set border color of th to black */

        }
        td {
            border: 1px solid #000; /* Set border color of td to the original color */
        }
        .wide-column {
            width: 20%;
        }
        .apply-button {
            display: inline-block;
            padding: 6px 12px;
            margin-top: 8px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 70%;
            height: auto;
            text-align: center;
            font-family: 'Inter', sans-serif;
            border: 5px solid black; /* Border color and width of the popup */

        }
        .popup-content h2, .popup-content p, .popup-content input, .popup-content button, .popup-content span {
            font-family: 'Inter', sans-serif;
        }
        .popup-content p {
            text-align: left;
        }

        .close-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 10px;
        }
        .submit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
            cursor: not-allowed;
            border-radius: 10px;
        }
        .submit-button.enabled {
            cursor: pointer;
        }

        .apply-button.disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            /* color: black; */
        }

        /* .line-div {
            width: 80%; /* or any width you prefer */
            /* text-align: left;
        } */

        .line {
            margin-bottom: 40px;
            text-align: left;
            font-family: 'Inter', sans-serif;
        }

        @media screen and (max-width: 991px) {
            table {
                width: 100%;
                font-size: 12px;
            }

            th, td {
                padding: 4px;
            }

            .wide-column {
                width: auto;
            }

            .popup-content {
                width: 80%;
            }
        }

        @media screen and (max-width: 767px) {
            table {
                font-size: 10px;
            }

            th, td {
                padding: 2px;
            }

            .popup-content {
                width: 90%;
            }
        }

        @media screen and (max-width: 479px) {
            table {
                font-size: 8px;
            }

            th, td {
                padding: 1px;
            }

            .popup-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <h1>Internship Listings</h1>
    <p class="line">Select and apply to one of the available internships.</p>
    <table>
        <tr>
            <th>Sr no</th>
            <th>Title</th>
            <th class="wide-column">Role</th>
            <th>Type</th>
            <th>Stipend</th>
            <th>Duration</th>
            <th>In hand amount</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>1</td>
            <td>LandInfo -satbaara</td>
            <td class="wide-column">Create wireframe and Mockup of a map based land ownership record app.</td>
            <td>REMOTE</td>
            <td>&#8377;2300p/m</td>
            <td>2 weeks</td>
            <td>&#8377;1150</td>
            <td><button class="apply-button" onclick="showPopup(1, 'Title 1', 'Role 1', '₹1200')">Apply</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>FinFlex News</td>
            <td class="wide-column">Design a Wireframe for a News App.</td>
            <td>REMOTE</td>
            <td>&#8377;3700p/m</td>
            <td>1 week</td>
            <td>&#8377;925</td>
            <td><button class="apply-button" onclick="showPopup(2, 'Title 2', 'Role 2', '₹925')">Apply</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td>MindSolace</td>
            <td class="wide-column">Design a Wireframe of a Mental Well-being product.</td>
            <td>REMOTE</td>
            <td>&#8377;4000p/m</td>
            <td>1 week</td>
            <td>&#8377;1000</td>
            <td><button class="apply-button" onclick="showPopup(3, 'Title 3', 'Role 3', '₹1000')">Apply</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td>BiteSite</td>
            <td class="wide-column">Create wireframe and Mockup of a reel based food ordering app.</td>
            <td>REMOTE</td>
            <td>&#8377;5000 p/m</td>
            <td>1 week</td>
            <td>&#8377;1250</td>
            <td><button class="apply-button" onclick="showPopup(4, 'Title 4', 'Role 4', '₹1250')">Apply</button></td>
        </tr>
        <tr>
            <td>5</td>
            <td>CogniTech</td>
            <td class="wide-column">Help to define the user model and user interface for various products and features</td>
            <td>HYBRID</td>
            <td>&#8377;8500 p/m</td>
            <td>1 week</td>
            <td>&#8377;2125</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Pixelmatic</td>
            <td class="wide-column">Collaborating with cross-functional teams to design intuitive user experiences, creating wireframes, prototypes, and design systems, conducting user research and usability testing, and ensuring design consistency across web and mobile platforms.</td>
            <td>HYBRID</td>
            <td>&#8377;12500p/m</td>
            <td>8 weeks</td>
            <td>&#8377;25,000</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Zepyr</td>
            <td class="wide-column">Deliver creative, development ready design assets to developers who implement the website across various platforms, and work closely with them to ensure the final build is consistent with the intended vision</td>
            <td>OFFLINE</td>
            <td>&#8377;32000 p/m</td>
            <td>16 weeks</td>
            <td>&#8377;1,28,000</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
    </table>
    <p class="line">*These are review based internships. To apply, you must first complete any of the remote internships listed above.</p>
    <div class="popup" id="popup">
        <div class="popup-content">
            <h2>Internship Details</h2>
            <p id="popup-content"></p>
            <p>To complete this internship, you have to send us the attached copy of your work and resume at the email address xyz@gmail.com. Please send the mail using the same email that you signed up with, because your payment information is bonded to your email by our payment processor.</p>
            <input type="checkbox" id="confirm-checkbox" onchange="toggleSubmitButton()"> Confirm application
            <br>
            <button id="submit-button" class="submit-button" onclick="submitApplication()" disabled>Submit</button>
            <span id="popup-close" class="close-button" onclick="hidePopup()">Close</span>
        </div>
    </div>


  <script>
        let Pno; // Declare the variable Pno globally

        const internshipDetails = {
    1: {
        title: 'LandInfo -SatBaara',
        role: `<p>Give this design a Figma mockup and wireframe for a Land Information App, including three key screens: Login/Signup, Map Interface, and Land Details Popup.</p>
    <h3>Requirements:</h3>
    <h3>Login/Signup Screen:</h3>
    <ul>
        <li>Design an intuitive interface for user authentication.</li>
        <li>Include options for both login and signup.</li>
    </ul>
    <h3>Map Interface Screen (for Logged-in Users):</h3>
    <ul>
        <li>Display a map centered around the user's current location, similar to Google Maps but without any buttons or toggles.</li>
        <li>Place a search bar at the top of the screen for users to search for specific locations or addresses.</li>
    </ul>
    <h3>Land Details Popup Screen:</h3>
    <ul>
        <li>When a user taps on any part of the map, highlight the selected area.</li>
        <li>A popup should slide up from the bottom of the screen displaying the following details:</li>
        <ul>
            <li>Owner's name</li>
            <li>Legal status of the land</li>
            <li>Area of the plot</li>
        </ul>
        <li>Include a "Find More Info" button within the popup for additional information.</li>
    </ul>`,
        amount: '₹1200'
    },
    2: {
        title: 'FinFlex News',
        role: `<h3>Requirements:</h3>
        <h3>Homepage:</h3>
    <ul>
        <li>Latest news</li>
        <li>Trending topics</li>
        <li>Market overviews</li>
    </ul>

    <h3>Detailed Article Pages:</h3>
    <ul>
        <li>Include multimedia content (images)</li>
    </ul>

    <h3>Push Notifications:</h3>
    <ul>
        <li>For breaking news</li>
        <li>For market updates</li>
    </ul>

    <h3>Design Requirements:</h3>
    <ul>
        <li>The design should be clean, visually appealing, and easy to navigate.</li>
    </ul>`,
        amount: '₹925'
    },
    3: {
        title: 'MindSolace',
        role: `<p>Design a wireframe for a mental health companion app that uses AI to provide personalized support.</p>

    <h3>Key Features:</h3>
    
    <h3>Tabs:</h3>
    <ul>
        <li>Mood Tracking</li>
        <li>AI-driven Cognitive-Behavioral Therapy (CBT) Sessions</li>
        <li>Mindfulness Exercises</li>
        <li>Community Support Forums</li>
    </ul>

    <h3>Design Requirements:</h3>
    <ul>
        <li>Emphasize a soothing, intuitive interface that encourages daily engagement.</li>
        <li>Ensure user privacy.</li>
    </ul>`,
        amount: '₹1000'
    },
    4: {
        title: 'BiteSite',
        role: `<h3>Overview:</h3>
    <p>BiteSight is a revolutionary video-based food delivery app that combines the engaging format of Reels with the convenience of food delivery services like Zomato/Swiggy. This is a single screen application!</p>
    
    <h3>Key Features to Include on Screen:</h3>
    <ol>
        <li>
            <strong>Video Feed:</strong> A full-screen video of a dish from a nearby restaurant. Users can scroll vertically to see videos from different nearby restaurants.
        </li>
        <li>
            Text Information at the bottom of the video displaying the dish name and price, and also the restaurant’s name, distance, and an option to save the current dish. Along with a big order now button.
        </li>
        <li>
            <strong>Ratings and Reviews:</strong> Display ratings from Google beneath the dish information.
        </li>
        <li>
            <strong>Swipe Functionality:</strong>
            <ul>
                <li><strong>Vertical Scrolling:</strong> To browse through videos of different dishes from various restaurants.</li>
                <li><strong>Horizontal Scrolling:</strong> To see other videos of the same restaurant.</li>
            </ul>
        </li>
    </ol>`,
        amount: '₹1250'
    }
};

function showPopup(srNo) {
    Pno = srNo;
    const internshipDetail = internshipDetails[srNo];

    if (internshipDetail) {
        document.getElementById('popup-content').innerHTML = `
            <strong>Sr no:</strong> ${srNo}<br>
            <strong>Title:</strong> ${internshipDetail.title}<br>
            <div style="max-height: 300px; overflow-y: auto;">
                <p>${internshipDetail.role}</p>
            </div><br>
            <strong>In hand amount:</strong> ${internshipDetail.amount}<br>
        `;
        document.getElementById('popup').style.display = 'flex';
    } else {
        console.error(`Internship details not found for Sr no ${srNo}`);
    }
}

        function hidePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function toggleSubmitButton() {
            const checkbox = document.getElementById('confirm-checkbox');
            const submitButton = document.getElementById('submit-button');
            if (checkbox.checked) {
                submitButton.disabled = false;
                submitButton.classList.add('enabled');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('enabled');
            }
        }

        document.getElementById('submit-button').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "apply.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.send("projectNo=" + Pno);
        });

        function submitApplication() {
            console.log('Pno:', Pno);
            alert('Application successful! Do the assigned work.');
            window.location.href = 'learn.php';
        }
    </script>

</body>
</html>
