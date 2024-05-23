<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>communication skills categories Form</title>
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
        <h2 style="margin-left: 100px;"><u>communication skills categories Form</u></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="category_id">Category ID:</label>
            <input type="number" id="category_id" name="category_id" required><br><br>
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" required><br><br>
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
            $stmt = $connection->prepare("INSERT INTO communicationskillscategories(category_id, category_name) VALUES (?, ?)");
            $stmt->bind_param("is", $category_id, $category_name);

            // Set parameters from POST and execute
            $category_id = $_POST['category_id'];
            $category_name = $_POST['category_name'];

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

        <h2>Table of communication skills categories</h2>
        <table>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
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
            $sql = "SELECT * FROM communicationskillscategories";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $category_id = $row["category_id"];
                    echo "<tr>
                            <td>" . $row["category_id"] . "</td>
                            <td>" . $row["category_name"] . "</td>
                            <td><a style='padding:4px' href='delete_Categories.php?category_id=$category_id'>Delete</a></td>
                            <td><a style='padding:4px' href='update_Categories.php?category_id=$category_id'>Update</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            // Close connection
            $connection->close();
            ?>
        </table>
    </div>
</body>

</html>
