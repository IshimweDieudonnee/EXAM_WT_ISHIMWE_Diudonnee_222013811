<?php
include 'database_connection.php';

// Function to show delete confirmation modal
function showDeleteConfirmation($ID) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($ID)">Confirm</button>
            <button onclick="returnToProduct()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(ID) {
        window.location.href = '?instructor_id=' + ID + '&confirm=yes';
    }
    function returnToProduct() {
        window.location.href = 'Instructors.php';
    }
    </script>
HTML;
}

// Check if ID is set
if(isset($_REQUEST['instructor_id'])) {
    $ID = $_REQUEST['instructor_id'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM instructors WHERE instructor_id=?");
        $stmt->bind_param("i", $ID);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'Instructors.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($ID);
    }
} else {
    echo "<script>alert('ID is not set.'); window.location.href = 'Instructors.php';</script>";
}

$connection->close();
?>
