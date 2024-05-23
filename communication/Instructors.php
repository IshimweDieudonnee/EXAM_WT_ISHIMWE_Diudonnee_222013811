<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>instructors Form</title>
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
        <h2 style="margin-left: 100px;"><u>instructors Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="instructor_id">Instructor ID:</label>
            <input type="number" id="instructor_id" name="instructor_id" required><br><br>

            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required><br><br>

            <label for="bio">Bio:</label>
            <input type="text" id="bio" name="bio" required><br><br>

            <input class="button" type="submit" name="add" value="Insert">

            <a class="button" href="./home.html">Go Back to Home</a>

        </form>
        
        <?php
        // Include database connection file
        include 'database_connection.php';

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
            // Prepare and bind
            $stmt = $connection->prepare("INSERT INTO instructors (instructor_id, user_id, bio) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $instructor_id, $user_id, $bio);

            // Set parameters and execute
            $instructor_id = $_POST['instructor_id'];
            $user_id = $_POST['user_id'];
            $bio = $_POST['bio'];

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

        <h2>Table of Instructors</h2>
        <table>
            <tr>
                <th>Instructor ID</th>
                <th>User ID</th>
                <th>Bio</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Include database connection file
            include 'database_connection.php';

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // SQL query to fetch data from the table
            $sql = "SELECT * FROM instructors";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ID = $row["instructor_id"];
                    echo "<tr>
                            <td>" . $row["instructor_id"] . "</td>
                            <td>" . $row["user_id"] . "</td>
                            <td>" . $row["bio"] . "</td>
                            <td><a style='padding:4px' href='delete_Instructors.php?ID=$ID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_Instructors.php?ID=$ID'>Update</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
            }

            // Close connection
            $connection->close();
            ?>
        </table>
    </div>
</body>

</html>