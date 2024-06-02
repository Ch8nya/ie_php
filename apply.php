<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
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
        
    </style>
</head>
<body>
    <h1>Internship Listings</h1>
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
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;2300p/m</td>
            <td>2 weeks</td>
            <td>&#8377;1150</td>
            <td><button class="apply-button" onclick="showPopup(1, 'Title 1', 'Role 1', '₹1200')">Apply</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;3700p/m</td>
            <td>1 week</td>
            <td>&#8377;925</td>
            <td><button class="apply-button" onclick="showPopup(2, 'Title 2', 'Role 2', '₹925')">Apply</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;4000p/m</td>
            <td>1 week</td>
            <td>&#8377;1000</td>
            <td><button class="apply-button" onclick="showPopup(3, 'Title 3', 'Role 3', '₹1000')">Apply</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;5000 p/m</td>
            <td>1 week</td>
            <td>&#8377;1250</td>
            <td><button class="apply-button" onclick="showPopup(4, 'Title 4', 'Role 4', '₹1250')">Apply</button></td>
        </tr>
        <tr>
            <td>5</td>
            <td></td>
            <td class="wide-column"></td>
            <td>HYBRID</td>
            <td>&#8377;8500 p/m</td>
            <td>1 week</td>
            <td>&#8377;2125</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
        <tr>
            <td>6</td>
            <td></td>
            <td class="wide-column"></td>
            <td>HYBRID</td>
            <td>&#8377;12500p/m</td>
            <td>8 weeks</td>
            <td>&#8377;25,000</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
        <tr>
            <td>7</td>
            <td></td>
            <td class="wide-column"></td>
            <td>OFFLINE</td>
            <td>&#8377;32000 p/m</td>
            <td>16 weeks</td>
            <td>&#8377;1,28,000</td>
            <td><button class="apply-button disabled" disabled>Apply*</button></td>
        </tr>
    </table>
<div class="popup" id="popup">
        <div class="popup-content">
            <span id="popup-close" class="close-button" onclick="hidePopup()">Close</span>
            <h2>Internship Details</h2>
            <p id="popup-content"></p>
            <p>To complete this internship, you have to send us the attached copy of your work and resume at the email address xyz@gmail.com. Please send the mail using the same email that you signed up with, because your payment information is bonded to your email by our payment processor.</p>
            <input type="checkbox" id="confirm-checkbox" onchange="toggleSubmitButton()"> Confirm application
            <br>
            <button id="submit-button" class="submit-button" onclick="submitApplication()" disabled>Submit</button>
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
