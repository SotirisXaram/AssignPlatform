<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Μεταπτυχιακό Machine Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- style.css -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
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


    <!-- Main -->
    <div class="container main my-4">
        <div class="mb-4 text-center">
            <p>Αν θες να υποβάλεις νέα εργασία κάνε κλικ εδώ:</p>
            <a href="ergasia.php"><button class="btn btn-success">Υποβολή Εργασίας</button></a>
            <h3 class="py-3">Portfolio Εργασιών</h3>
        </div>

        <!-- Accordion -->
        <div class="accordion" id="coursesAccordion">
        <?php
            $user_id = $_SESSION['user_id'];

            // Ανάκτηση μαθημάτων από τη βάση δεδομένων
            $sql_courses = "SELECT * FROM courses";
            $result_courses = $conn->query($sql_courses);

            if ($result_courses->num_rows > 0) {

                while ($course = $result_courses->fetch_assoc()) {
                    $course_id = $course['course_id'];
                    $course_title = $course['course_title'];

                    // Fetch all submissions for the current user and course
                    $sql_submissions = "SELECT * FROM submitted_assignment  
                                      JOIN assignment_description  ON submitted_assignment.assignment_id = assignment_description.assignment_id 
                                      WHERE submitted_assignment.user_id = $user_id AND assignment_description.course_id = $course_id";
                    $result_submissions = $conn->query($sql_submissions);

                    // Fetch all assignments for the current course
                    $sql_assignments = "SELECT * FROM assignment_description WHERE course_id = $course_id";
                    $result_assignments = $conn->query($sql_assignments);

                    if ($result_assignments->num_rows > 0) {
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#course<?php echo $course_id; ?>">
                                    <?php echo $course_title; ?>
                                </button>
                            </h2>
                            <div id="course<?php echo $course_id; ?>" class="accordion-collapse collapse show"
                                data-bs-parent="#coursesAccordion">
                                <div class="accordion-body">
                                    <?php
                                    // Display all assignments
                                    while ($assignment = $result_assignments->fetch_assoc()) {
                                        $is_submitted = false;

                                        // Check if the user has already submitted the assignment
                                        if ($result_submissions->num_rows > 0) {
                                            // Check if there is a submission for this assignment
                                            while ($submission = $result_submissions->fetch_assoc()) {
                                                if ($submission['assignment_id'] == $assignment['assignment_id']) {
                                                    $is_submitted = true;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-2">
                                                    <img src="<?php echo 'uploads/' . $assignment['assignment_image']; ?>"
                                                        class="img-fluid">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body">
                                                        <h2 class="card-title"><?php echo $assignment['assignment_title']; ?></h2>
                                                        <p class="card-text"><?php echo $assignment['assignment_text']; ?></p>
                                                        <?php if ($is_submitted) { ?>
                                                            <button class="btn btn-secondary" disabled>Υποβλήθηκε</button>
                                                        <?php } else { ?>
                                                            <a href="ergasia.php?id=<?php echo $assignment['assignment_id']; ?>">
                                                                <button class="btn btn-success">Υποβολή Εργασίας</button>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<div class="alert alert-info">Δεν υπάρχουν διαθέσιμα μαθήματα.</div>';
            }
            ?>
        </div>
    </div>
    
    <br>
    <br>
    <br>
    <br>


    <!-- Footer.  -->
    <footer class="footer">
        <div class="container text-center">
            <a href="pdf/terms.pdf" target="_blank">Όροι χρήσης</a>&emsp;|&emsp;
            <a href="pdf/privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

     <!-- Script την προσθηκη της κλασσης active ετσι ωστε να ειναι highlight το επιλεγμενο -->
     <script>
      
        const links = document.querySelectorAll('.nav-link');
        
        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active'); 
            }
        });
    </script>
</body>

</html>
