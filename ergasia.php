<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Πλατφόρμα Μεταπτυχιακού</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>


<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    include('config.php');  //Σύνδεση με την βάση
    session_start(); 
    ?>
    <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" class="logo">
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
    </div>
</header>

<body>
    <?php
    $user_id = $_SESSION['user_id'];

    // Υποβολή εργασίας
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

            // Ελέγχω εάν η υποβολή υπάρχει ήδη
            $check_query = "SELECT * FROM submitted_assignment 
                               WHERE user_id = '$user_id' 
                               AND assignment_id = '$assignment_id'";
            $check_result = mysqli_query($conn, $check_query);
 
            if (mysqli_num_rows($check_result) > 0) {
                $update_query = "UPDATE submitted_assignment 
                                    SET submission_title = '$title', 
                                        submission_description = '$description', 
                                        submission_file = '$file_path', 
                                        submission_timestamp = NOW() 
                                    WHERE user_id = '$user_id' 
                                    AND assignment_id = '$assignment_id'";

                // Μήνυμα ενημέρωσης εργασίας
                if (mysqli_query($conn, $update_query)) {
                    echo "<div class='alert alert-success alert-dismissible fade show custom-alert container main-content3 my-4' role='alert'>
                                Η εργασία ενημερώθηκε επιτυχώς!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                } else {
                    echo "<div class='alert alert-danger alert-dismissible fade show custom-alert container main-content3 my-4' role='alert'>
                                Σφάλμα κατά την ενημέρωση: " . mysqli_error($conn) . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                }
            } else {
    
                $insert_query = "INSERT INTO submitted_assignment 
                                    (user_id, assignment_id, submission_title, submission_description, submission_file) 
                                    VALUES 
                                    ('$user_id', '$assignment_id', '$title', '$description', '$file_path')";

                // Μήνυμα εισαγωγής εργασίας
                if (mysqli_query($conn, $insert_query)) {
                    echo "<div class='alert alert-success alert-dismissible fade show custom-alert container main-content3 my-4' role='alert'>
                                Η εργασία υποβλήθηκε επιτυχώς!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                } else {
                    echo "<div class='alert alert-danger alert-dismissible fade show custom-alert container main-content3 my-4' role='alert'>
                                Σφάλμα κατά την υποβολή: " . mysqli_error($conn) . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                }
            }
        } else {
            // Μήνυμα σφάλματος
            echo "<div class='alert alert-danger alert-dismissible fade show custom-alert container main-content3 my-4' role='alert'>
                        Σφάλμα κατά την αποθήκευση του αρχείου!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
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
        $submission_query = "SELECT * FROM submitted_assignment 
                            WHERE user_id = '$user_id' 
                            AND assignment_id = '$assignment_id'";
        $submission_result = mysqli_query($conn, $submission_query);

        if (mysqli_num_rows($submission_result) > 0) {
            $submission_exists = true;
            $submission_data = mysqli_fetch_assoc($submission_result);
        }
    }
    ?>


    <div class="container main-content3 my-4">
        <h1 class="text-center mb-4">Υποβολή Εργασίας</h1>
        <p class="text-center text-muted mb-4">Υποβάλετε μια νέα εργασία, αφού πρώτα επιλέξετε το σωστό μάθημα.</p>
        <div class="profile-form">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <b><label for="course" class="form-label">Μάθημα</label></b>
                    <select class="form-select" id="course" name="course" required onchange="updateAssignments()">
                        <option selected disabled>Επιλέξτε μάθημα</option>
                        <?php
                        $result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($course_id == $row['course_id']) ? 'selected' : '';
                            echo "<option value='" . $row['course_id'] . "' $selected>" . $row['course_title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <b><label for="assignment" class="form-label">Εργασία</label></b>
                    <select class="form-select" id="assignment" name="assignment" required onchange="checkSubmission()">
                        <option selected disabled>Επιλέξτε εργασία</option>
                        <?php
                        if ($course_id) {
                            $result2 = mysqli_query($conn, "SELECT * FROM assignment_description WHERE course_id = '$course_id' ORDER BY assignment_id");
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $selected = ($assignment_id == $row['assignment_id']) ? 'selected' : '';
                                echo "<option value='" . $row['assignment_id'] . "' $selected>" . $row['assignment_title'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <b><label for="title" class="form-label">Τίτλος Εργασίας</label></b>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Πληκτρολογήστε τον τίτλο της εργασίας" required value="<?php
                        if ($submission_exists) {
                            echo $submission_data['submission_title'];
                        } else {
                            echo '';
                        }
                        ?>">
                </div>

                <div class="mb-3">
                    <b><label for="description" class="form-label">Περιγραφή</label></b>
                    <textarea class="form-control" id="description" name="description" rows="4"
                        placeholder="Πληκτρολογήστε την περιγραφή της εργασίας" required><?php
                        if ($submission_exists) {
                            echo $submission_data['submission_description'];
                        } else {
                            echo '';
                        }
                        ?></textarea>
                </div>

                <div class="mb-3">
                    <b><label for="file" class="form-label">Αρχείο Εργασίας (PDF)</label></b>
                    <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary px-4">Υποβολή</button>
                    <?php if ($submission_exists): ?>
                        <a href="<?php echo $submission_data['submission_file']; ?>"
                            class="btn btn-success px-4 ms-3" target="_blank">
                            Λήψη Υποβληθείσας Εργασίας
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <br><br>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <a href="pdf\terms.pdf" target="_blank">Όροι χρήσης</a>&emsp;|&emsp;
            <a href="pdf\privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
        </div>
    </footer>

    <script>
        // Επιλογή μαθήματος
        function updateAssignments() {
            var course = document.getElementById('course').value;
            window.location.href = "ergasia.php?course_id=" + course;
        }

        // Επιλογή εργασίας
        function checkSubmission() {
            var course = document.getElementById('course').value;
            var assignment = document.getElementById('assignment').value;
            if (course && assignment) {
                window.location.href = "ergasia.php?course_id=" + course + "&assignment_id=" + assignment;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>