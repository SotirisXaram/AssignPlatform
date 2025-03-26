<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Πλατφόρμα Μεταπτυχιακού</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>


<header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
        include('config.php'); 
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
    </header>

<body>
    <!-- Ερώτηση 4 – Σελίδες για Καθηγητές «Προβολή Εργασιών» -->
    <div class="container main-content my-4">
        <h1 class="text-center mb-4">Προβολή Εργασιών</h1>
        <p class="text-center text-muted mb-4">Επιλέξτε μάθημα για να δείτε τις εκφωνήσεις και τις υποβληθείσες
            εργασίες.</p>

        <!-- Επιλογή μαθήματος -->
        <div class="row justify-content-center mb-5">
            <div class="col-my-4">
                <form method="GET" action="">

                    <b><label for="course" class="form-label">Μάθημα</label></b>
                    <select class="form-select" id="course" name="course_id" onchange="this.form.submit()">
                        <option value="" selected disabled>Επιλέξτε μάθημα</option>
                        <?php
                        // Σύνδεση με τη βάση και λήψη των μαθημάτων
                        include('config.php');
                        $result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = (isset($_GET['course_id']) && $_GET['course_id'] == $row['course_id']) ? 'selected' : '';
                            echo "<option value='" . $row['course_id'] . "' $selected>" . $row['course_title'] . "</option>";
                        }
                        ?>
                    </select>

                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];

            $assignments_query = "SELECT * FROM assignment_description WHERE course_id = '$course_id' ORDER BY assignment_id ";
            $assignments_result = mysqli_query($conn, $assignments_query);

            if (mysqli_num_rows($assignments_result) > 0) {
                echo '<div class="assignments-list">';

                while ($assignment = mysqli_fetch_assoc($assignments_result)) {
                    $assignment_id = $assignment['assignment_id'];
                    $assignment_title = $assignment['assignment_title'];
                    $assignment_text = $assignment['assignment_text'];
                    $assignment_image = $assignment['assignment_image'];

                    echo '<div class="card mb-5">';
                    echo '<div class="card-header bg-primary text-white">';
                    echo '<h3>' . $assignment_title . '</h3>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<div class="row">';

                    echo '<div class="col-md-2">';
                    echo '<h5 class="card-title">Εικόνα Εργασίας:</h5>';
                    echo '<img src="uploads/' . $assignment_image . '" class="img-fluid rounded" alt="Εικόνα εργασίας">';
                    echo '</div>';
              
        
                    echo '<div class="col-md-10">';
                    echo '<h5 class="card-title">Πλήρης Εκφώνηση Εργασίας:</h5>';
                    echo '<p class="card-text">' . nl2br($assignment_text) . '</p>';
                    echo '</div>';

                    echo '</div>'; 
                    echo '<hr class="mt-4">';
                    echo '<h5 class="card-title mt-4">Υποβληθείσες Εργασίες:</h5>';

                    $submissions_query = "SELECT *
                                         FROM submitted_assignment sa 
                                         JOIN users u ON sa.user_id = u.user_id
                                         JOIN user_profile ON sa.user_id = user_profile.user_id
                                         WHERE sa.assignment_id = '$assignment_id' 
                                         ORDER BY sa.submission_timestamp DESC";
                    $submissions_result = mysqli_query($conn, $submissions_query);

                    if (mysqli_num_rows($submissions_result) > 0) {
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-hover">';
                        echo '<thead class="table-light">';
                        echo '<tr>';
                        echo '<th>Ονοματεπώνυμο Φοιτητή</th>';
                        echo '<th>Τίτλος Υποβολής</th>';
                        echo '<th>Ημερομηνία Υποβολής</th>';
                        echo '<th>Αρχείο Εργασίας</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($submission = mysqli_fetch_assoc($submissions_result)) {
                            echo '<tr>';
                            echo '<td>' . $submission['full_name'] . '</td>';
                            echo '<td>' . $submission['submission_title'] . '</td>';
                            echo '<td>' . date('d/m/Y H:i:s', strtotime($submission['submission_timestamp'])) . '</td>';
                            echo '<td><a href="' . $submission['submission_file'] . '" class="btn btn-sm btn-outline-primary" download>Λήψη Αρχείου</a></td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';  
                    } else {
                        echo '<div class="alert alert-info">Δεν έχουν υποβληθεί εργασίες ακόμα για αυτή την εκφώνηση.</div>';
                    }

                    echo '</div>';  
                    echo '</div>';  
                }

                echo '</div>';  
            } else {
                echo '<div class="alert alert-warning">Δεν βρέθηκαν εκφωνήσεις εργασιών για το επιλεγμένο μάθημα.</div>';
            }
        }
        ?>
    </div>
<br><br>
</body>


<footer class="footer">
    <div class="container text-center">
        <a href="pdf\terms.pdf" target="_blank">Όροι χρήσης</a>&emsp;|&emsp;
        <a href="pdf\privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
    </div>
</footer>


<!-- Script την προσθηκη της κλασσης active ετσι ωστε να ειναι highlight το επιλεγμενο -->
<script>
 
   const links = document.querySelectorAll('.nav-link');
   
   links.forEach(link => {
       if (link.href === window.location.href) {
           link.classList.add('active'); 
       }
   });
</script>

</html>