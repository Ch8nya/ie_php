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
            border: none;
            cursor: pointer;
        }
        .apply-button:hover {
            background-color: #45a049;
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
            <td><button class="apply-button">Apply</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;3700p/m</td>
            <td>1 week</td>
            <td>&#8377;925</td>
            <td><button class="apply-button">Apply</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;4000p/m</td>
            <td>1 week</td>
            <td>&#8377;1000</td>
            <td><button class="apply-button">Apply</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td></td>
            <td class="wide-column"></td>
            <td>REMOTE</td>
            <td>&#8377;5000 p/m</td>
            <td>1 week</td>
            <td>&#8377;1250</td>
            <td><button class="apply-button">Apply</button></td>
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

</body>
</html>
