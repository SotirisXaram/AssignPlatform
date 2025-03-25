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
        session_start(); // Για να ξεκινήσουν τα sessions
        include('config.php'); //Σύνδεση με την βάση
        //print_r($_SESSION);//Εμφάνιση πίνακα SESSION
        // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.html");
            exit();
        }

        //To id του χρήστη
        $user_id = $_SESSION['user_id'];

        // Ανάκτηση δεδομένων προφίλ
        $query = "SELECT full_name, occupation, linkedin, facebook, youtube, instagram, twitter FROM user_profile WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $userProfile = mysqli_fetch_assoc($result);
        ?>
        <!-- Ελεγχος εαν εχουν αλλαξει τα δεδομενα με το success -->
        <?php if (isset($_GET['success'])): ?>
            echo '<script language="javascript">alert("Τα στοιχεία αποθηκεύτηκαν με επιτυχία"); document.location="profile.php";</script>';
        <?php endif; ?>



        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" style="height: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Αρχική</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portofolio.php">Portfolio Εργασιών</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Προφίλ</a>
                    </li>
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

    <div class="container main-profil my-4">
        <h2 class="text-center mb-2">Προφίλ Χρήστη</h2>
        <p class="text-center text-muted mb-4">Για να κρατήσεις επαφή με το ίδρυμα μετά την αποφοίτηση σου, συμπλήρωσε
            όσο περισσότερα στοιχεία μπορείς!</p>
        <div class="profile-form">
            <form action="profile_update.php" method="post">
                <!-- Όνομα/Επώνυμο -->
                <div class="mb-2">
                    <b><label for="fullName" class="form-label">Όνομα και Επώνυμο</label></b>
                    <input type="text" class="form-control" id="fullName" name="fullName"
                    <?php if(!empty($userProfile['full_name'])) { ?>
                        value="<?php echo $userProfile['full_name']; ?>" 
                    <?php } else { ?>
                        placeholder="Πληκτρολόγησε το όνομα και το επώνυμό σου"
                    <?php } ?>>
       
                </div>

                <!-- Επαγγελματικα -->
                <div class="mb-2">
                    <b><label for="occupation" class="form-label">Επαγγελματική Ενασχόληση</label></b>
                    <input type="text" class="form-control" id="occupation" name="occupation"
                    <?php if(!empty($userProfile['occupation'])) { ?>
                        value="<?php echo $userProfile['occupation']; ?>"
                    <?php } else { ?>
                        placeholder="Συμπλήρωσε την επαγγελματική σου ενασχόληση"
                    <?php } ?>>
                </div>

                <!-- Social -->
                <div class="mb-2">
                    <b><label for="linkedin" class="form-label">LinkedIn</label></b>
                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                    <?php if(!empty($userProfile['linkedin'])) { ?>
                        value="<?php echo $userProfile['linkedin']; ?>"
                    <?php } else { ?>
                        placeholder="URL για τον λογαριασμό σου στο LinkedIn"
                    <?php } ?>>
                </div>

                <div class="mb-2">
                    <b><label for="facebook" class="form-label">Facebook</label></b>
                    <input type="url" class="form-control" id="facebook" name="facebook"
                    <?php if(!empty($userProfile['facebook'])) { ?>
                        value="<?php echo $userProfile['facebook']; ?>"
                    <?php } else { ?>
                        placeholder="URL για τον λογαριασμό σου στο Facebook"
                    <?php } ?>>
                </div>

                <div class="mb-2">
                    <b><label for="youtube" class="form-label">YouTube</label></b>
                    <input type="url" class="form-control" id="youtube" name="youtube"
                    <?php if(!empty($userProfile['youtube'])) { ?>
                        value="<?php echo $userProfile['youtube']; ?>"
                    <?php } else { ?>
                        placeholder="URL για τον λογαριασμό σου στο YouTube"
                    <?php } ?>>
                </div>

                <div class="mb-2">
                    <b><label for="instagram" class="form-label">Instagram</label></b>
                    <input type="url" class="form-control" id="instagram" name="instagram"
                    <?php if(!empty($userProfile['instagram'])) { ?>
                        value="<?php echo $userProfile['instagram']; ?>"
                    <?php } else { ?>
                        placeholder="URL για τον λογαριασμό σου στο instagram"
                    <?php } ?>>
                </div>

                <div class="mb-2">
                    <b><label for="twitter" class="form-label">Twitter/X</label></b>
                    <input type="url" class="form-control" id="twitter" name="twitter"
                    <?php if(!empty($userProfile['twitter'])) { ?>
                        value="<?php echo $userProfile['twitter']; ?>"
                    <?php } else { ?>
                        placeholder="URL για τον λογαριασμό σου στο Twitter/X"
                    <?php } ?>>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-primary px-4">Αποθήκευση</button>
                </div>
            </form>
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