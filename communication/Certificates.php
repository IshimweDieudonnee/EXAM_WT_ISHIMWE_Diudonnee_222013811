<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>certificates Form</title>
</head>
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
        <h2 style="margin-left: 100px;"><u>certificates Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="attendee_id">Certificate ID:</label>
        <input type="number" id="certificate_id" name="certificate_id" required><br><br>
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>
        <label for="user_id">Workshop ID:</label>
        <input type="number" id="workshop_id" name="workshop_id" required><br><br>
        <label for="user_id">Issue Date:</label>
        <input type="date" id="issue_date" name="issue_date" required><br><br>
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
            $stmt = $connection->prepare("INSERT INTO certificates(certificate_id, user_id, workshop_id, issue_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $certificate_id, $user_id, $workshop_id, $issue_date);

            // Set parameters from POST and execute
            $certificate_id = $_POST['certificate_id'];
            $user_id = $_POST['user_id'];
            $workshop_id = $_POST['workshop_id'];
            $issue_date = $_POST['issue_date'];

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

        <h2>Table of certificates</h2>
        <table>
            <tr>
                <th>Certificate ID</th>
                <th>User ID</th>
                <th>Workshop ID</th>
                <th>Issue Date</th>
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
            $sql = "SELECT * FROM certificates";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ID = $row["certificate_id"];
                    echo "<tr>
                            <td>" . $row["certificate_id"] . "</td>
                            <td>" . $row["user_id"] . "</td>
                            <td>" . $row["workshop_id"] . "</td>
                            <td>" . $row["issue_date"] . "</td>
                            <td><a style='padding:4px' href='delete_Certificates.php?ID=$ID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_Certificates.php?ID=$ID'>Update</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }

            // Close connection
            $connection->close();
            ?>
        </table>
    </div>
</body>

</html>
