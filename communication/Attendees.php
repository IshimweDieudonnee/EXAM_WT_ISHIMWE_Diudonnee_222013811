<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendee Form</title>
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
        <h2 style="margin-left: 100px;"><u>Attendee Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="attendee_id">Attendee ID:</label>
            <input type="number" id="attendee_id" name="attendee_id" required><br><br>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required><br><br>
            <input class="button" type="submit" name="add" value="Insert">
            <a class="button" href="./home.html">Go Back to Home</a>
        </form>
        <?php
        // Link for database Connection
        include 'database_connection.php';
        
        // Check if the connection is established
        if (isset($connection)) {
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
        
            // Check if the form is submitted for insert
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                // Prepare and bind parameters for the insert statement
                $stmt = $connection->prepare("INSERT INTO Attendees(attendee_id, user_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $attendee_id, $user_id);
        
                // Set parameters from POST and execute
                $attendee_id = $_POST['attendee_id'];
                $user_id = $_POST['user_id'];
        
                if ($stmt->execute()) {
                    echo "<p>New record has been added successfully.</p>";
                } else {
                    echo "<p>Error inserting data: " . $stmt->error . "</p>";
                }
        
                $stmt->close();
            }
        
            // Close connection
            $connection->close();
        } else {
            echo "<p>Database connection is not established.</p>";
        }
        ?>

        <h2>Table of Attendees</h2>
        <table>
            <tr>
                <th>Attendee ID</th>
                <th>User ID</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Link for database Connection
            include 'database_connection.php';
            
            // Check if the connection is established
            if (isset($connection)) {
                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
        
                // SQL query to fetch data from the Attendees table
                $sql = "SELECT * FROM Attendees";
                $result = $connection->query($sql);
        
                if ($result === false) {
                    echo "Error fetching data: " . $connection->error;
                } elseif ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $attendee_id = $row["attendee_id"];
                        echo "<tr>
                                <td>" . $row["attendee_id"] . "</td>
                                <td>" . $row["user_id"] . "</td>
                                <td><a style='padding:4px' href='delete_attendees.php?attendee_id=$attendee_id'>Delete</a></td>
                                <td><a style='padding:4px' href='update_attendees.php?attendee_id=$attendee_id'>Update</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
        
                // Close connection
                $connection->close();
            } else {
                echo "<tr><td colspan='4'>Database connection is not established.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
