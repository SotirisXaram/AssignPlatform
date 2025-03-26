<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Μεταπτυχιακό Machine Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- style.css -->
    <link rel="stylesheet" href="style.css">

</head>

    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
        include('config.php'); 
        session_start(); 
        ?>
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" style="height: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation  -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Αρχική</a>
                    </li>
                    <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
                    echo '<li class="nav-item">
                    <a class="nav-link active" href="portfolio.php">Portfolio Εργασιών</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Προφίλ</a>
                    </li>';
                } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'professor') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="create_ergasia.php">Δημιουργία Εργασίας</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_ergasies.php">Προβολή Εργασιών</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_foititis.php">Εικόνα Φοιτητή</a>
                    </li>';
                } ?>
                </ul>
                <?php if (isset($_SESSION['user_id'])) {
                echo '<button type="button" class="btn btn-danger btn-lg"><a href="logout.php" 
						class="nav-link">Έξοδος</a></button>';
            } else {
                echo '<button type="button" class="btn btn-primary btn-lg"><a href="login.html" 
						class="nav-link">Είσοδος</a></button>';
            }
            ?>
                
            </div>
        </div>
    </header>


    <body>
    <?php
    $user_id = $_SESSION['user_id'];
    $submission_exists = false;
    $submission_data = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = $_POST['course'];
        $assignment_id = $_POST['assignment'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file_name = $_FILES['file']['name'];
        $file_path = "uploads/" . $file_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
            $check_query = "SELECT * FROM submitted_assignment WHERE user_id = '$user_id' AND assignment_id = '$assignment_id'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                $update_query = "UPDATE submitted_assignment SET submission_title = '$title', submission_description = '$description', submission_file = '$file_path', submission_timestamp = NOW() WHERE user_id = '$user_id' AND assignment_id = '$assignment_id'";
                mysqli_query($conn, $update_query);
            } else {
                $insert_query = "INSERT INTO submitted_assignment (user_id, assignment_id, submission_title, submission_description, submission_file) VALUES ('$user_id', '$assignment_id', '$title', '$description', '$file_path')";
                mysqli_query($conn, $insert_query);
            }
        }
    }

    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
    } else {
        $course_id = null;
    }

    if (isset($_GET['assignment_id'])) {
        $assignment_id = $_GET['assignment_id'];
    } else {
        $assignment_id = null;
    }

    if ($course_id && $assignment_id) {
        $submission_query = "SELECT * FROM submitted_assignment WHERE user_id = '$user_id' AND assignment_id = '$assignment_id'";
        $submission_result = mysqli_query($con, $submission_query);
        if (mysqli_num_rows($submission_result) > 0) {
            $submission_exists = true;
            $submission_data = mysqli_fetch_assoc($submission_result);
        }
    }
    ?>

    <div class="container main-content3 my-4">
        <h1 class="text-center mb-4">Υποβολή Εργασίας</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="course" class="form-label">Μάθημα</label>
                <select class="form-select" id="course" name="course" required onchange="updateAssignments()">
                    <option selected disabled>Επιλέξτε μάθημα</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['course_id']}'>{$row['course_title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="assignment" class="form-label">Εργασία</label>
                <select class="form-select" id="assignment" name="assignment" required onchange="checkSubmission()">
                    <option selected disabled>Επιλέξτε εργασία</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT assignment_id, assignment_title FROM assignments WHERE course_id = '$course_id'");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['assignment_id']}'>{$row['assignment_title']}</option>";
                    }
                    ?>
    
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Τίτλος Εργασίας</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Περιγραφή</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Αρχείο Εργασίας (PDF)</label>
                <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary px-4">Υποβολή</button>
        </form>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <a href="pdf/terms.pdf" target="_blank">Όροι χρήσης</a> | <a href="pdf/privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
        </div>
    </footer>
    
</body>
</html>
