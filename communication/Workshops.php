<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>workshops Form</title>
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
        <h2 style="margin-left: 100px;"><u>workshops Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" id="workshop_id" name="workshop_id" required><br><br>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br><br>

            <label for="instructor_id">Instructor ID:</label>
            <input type="number" id="instructor_id" name="instructor_id" required><br><br>

            <label for="category_id">Category ID:</label>
            <input type="number" id="category_id" name="category_id" required><br><br>

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
            $stmt = $connection->prepare("INSERT INTO workshops(workshop_id, title, description, instructor_id, category_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issii", $workshop_id, $title, $description, $instructor_id, $category_id);

            // Set parameters from POST and execute
            $workshop_id = $_POST['workshop_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $instructor_id = $_POST['instructor_id'];
            $category_id = $_POST['category_id'];

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

        <h2>Table of workshops</h2>
        <table>
            <tr>
                <th>Workshop ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Instructor ID</th>
                <th>Category ID</th>
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
            $sql = "SELECT * FROM workshops";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ID = $row["workshop_id"];
                    echo "<tr>
                            <td>" . $row["workshop_id"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["description"] . "</td>
                            <td>" . $row["instructor_id"] . "</td>
                            <td>" . $row["category_id"] . "</td>
                            <td><a style='padding:4px' href='delete_Workshops.php?ID=$ID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_Workshops.php?ID=$ID'>Update</a></td>
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
