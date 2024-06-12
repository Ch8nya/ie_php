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
            overflow: auto; /* Add this to make the content scrollable */    
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
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #2d2f31;
            color: white;
            border: 1px solid white;
        }

        td {
            border: 1px solid #000;
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
            width: 50%;
            text-align: center;
        }

        .close-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
            cursor: not-allowed;
        }

        .submit-button.enabled {
            cursor: pointer;
        }

        .apply-button.disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .line {
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
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
            <p>To complete this internship, you have to send us the attached copy of your work and resume at the email address submissions@earninternship.com. Please send the mail using the same email that you signed up with, because your payment information is bonded to your email by our payment processor.</p>
            <input type="checkbox" id="confirm-checkbox" onchange="toggleSubmitButton()"> Confirm application
            <br>
            <button id="submit-button" class="submit-button" onclick="submitApplication()" disabled>Submit</button>
            <span id="popup-close" class="close-button" onclick="hidePopup()">Close</span>
        </div>
    </div>

  <script>
    let Pno; // Declare the variable Pno globally

    function showPopup(srNo, title, role, amount) {
        Pno = srNo; // Store Sr no in the variable Pno
        document.getElementById('popup-content').innerHTML = `
            <strong>Sr no:</strong> ${srNo}<br>
            <strong>Title:</strong> ${title}<br>
            <strong>Role:</strong> ${role}<br>
            <strong>In hand amount:</strong> ${amount}<br>
        `;
        document.getElementById('popup').style.display = 'flex';
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
