<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>workshopschedule Form</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid black;
        }

        /* Navigation Bar Styles */
        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="./Instructors.php">Instructors</a></li>
                <li><a href="./Workshops.php">Workshops</a></li>
                <li><a href="./Attendees.php">Attendees</a></li>
                <li><a href="./Resources.php">Communication Skills Resources</a></li>
                <li><a href="./Feedback.php">Feedback</a></li>
                <li><a href="./Schedule.php">Workshop Schedule</a></li>
                <li><a href="./Registration.php">Registration</a></li>
                <li><a href="./Categories.php">Communication Skills Categories</a></li>
                <li><a href="./Certificates.php">Certificates</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <h2 style="margin-left: 100px;"><u>workshopschedule Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="schedule_id">Schedule ID:</label>
            <input type="number" id="schedule_id" name="schedule_id" required><br><br>

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" id="workshop_id" name="workshop_id" required><br><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required><br><br>

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required><br><br>

            <input class="button" type="submit" name="add" value="Insert">
            <a class="button" href="./home.html">Go Back to Home</a>

        </form>
        <?php
        //link for database Connection
        include 'database_connection.php';
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
            // Insert section
            $stmt = $connection->prepare("INSERT INTO workshopschedule(schedule_id, workshop_id, date, start_time, end_time) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $schedule_id, $workshop_id, $date, $start_time, $end_time);

            // Set parameters from POST and execute
            $schedule_id = $_POST['schedule_id'];
            $workshop_id = $_POST['workshop_id'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];

            if ($stmt->execute()) {
                echo "New record has been added successfully.";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        }

        // Close connection
        $connection->close();
        ?>

        <h2>Table of workshop schedule</h2>
        <table>
            <tr>
                <th>Schedule ID</th>
                <th>Workshop ID</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            //link for database Connection
            include 'database_connection.php';
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // SQL query to fetch data from the table
            $sql = "SELECT * FROM workshopschedule";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ID = $row["schedule_id"];
                    echo "<tr>
                            <td>" . $row["schedule_id"] . "</td>
                            <td>" . $row["workshop_id"] . "</td>
                            <td>" . $row["date"] . "</td>
                            <td>" . $row["start_time"] . "</td>
                            <td>" . $row["end_time"] . "</td>
                            <td><a style='padding:4px' href='delete_Schedule.php?ID=$ID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_Schedule.php?ID=$ID'>Update</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }

            // Close connection
            $connection->close();
            ?>
        </table>
    </div>
</body>

</html>
