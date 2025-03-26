-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: localhost
-- Χρόνος δημιουργίας: 26 Μαρ 2025 στις 23:05:47
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `charamidis_database`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `assignment_description`
--

CREATE TABLE `assignment_description` (
  `assignment_id` int(11) NOT NULL,
  `assignment_title` varchar(255) NOT NULL,
  `assignment_text` text NOT NULL,
  `assignment_image` varchar(255) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `assignment_description`
--

INSERT INTO `assignment_description` (`assignment_id`, `assignment_title`, `assignment_text`, `assignment_image`, `course_id`) VALUES
(13, 'Εργασια 1', 'Στόχος της άσκησης είναι να συνεχίσουμε την υλοποίηση της πλατφόρμας η οποία ξεκίνησε στη\r\nΓΕ2, για τη διαχείριση προφίλ και εργασιών φοιτητών σε ένα μεταπτυχιακό πρόγραμμα σπουδών,\r\nμε την ενσωμάτωση δυνατοτήτων που βασίζονται σε HTML, PHP, JavaScript και SQL. Για το\r\nσύστημα που θα αναπτύξετε μπορείτε: α) να βασιστείτε στην υλοποίηση που κάνατε για την\r\nΆσκηση 5 της ΓΕ2, β) να αξιοποιήσετε την ενδεικτική λύση που δόθηκε, ή γ) να ξεκινήσετε νέα\r\nυλοποίηση από την αρχή.', 'ergasia.jpg', 4),
(14, 'Εργασια 2', 'Η πλατφόρμα θα αποτελείται από μία Βάση Δεδομένων (ΒΔ) και από ένα web περιβάλλον\r\nδιεπαφής (web interface). Στη Βάση Δεδομένων θα αποθηκεύονται πληροφορίες για τους χρήστες\r\nτης πλατφόρμας (φοιτητές, καθηγητές), τα καταχωρημένα μαθήματα και τις καταχωρημένες\r\nεργασίες.\r\nΤα στοιχεία σύνδεσης των λογαριασμών των χρηστών (username, password) θα έχουν εισαχθεί εκ\r\nτων προτέρων στη ΒΔ, χωρίς δυνατότητα μεταβολής τους κατά τη λειτουργία της πλατφόρμας.', 'ergasia.jpg', 4),
(15, 'Εργασια 3', 'Για τη δημιουργία της Βάσης Δεδομένων μπορεί να χρησιμοποιηθεί το εργαλείο phpMyAdmin, το\r\nοποίο είναι ενσωματωμένο στο πακέτο XAMPP. Αφού έχετε ξεκινήσει σωστά το XAMPP, ανοίξτε το\r\nControl Panel του, και ξεκινήστε τον Apache Web Server και την MariaDB. Στη συνέχεια,\r\nπληκτρολογήστε τη διεύθυνση http://localhost σε έναν browser. Από την αρχική σελίδα που θα\r\nανοίξει, επιλέξτε το σύνδεσμο phpMyAdmin από το επάνω μενού (εναλλακτικά, πληκτρολογήστε\r\nκατευθείαν τη διεύθυνση http://localhost/phpmyadmin/ στον browser σας).', 'ergasia.jpg', 4),
(16, 'Εργασια 1', 'Η παραπάνω περιγραφή είναι ενδεικτική και έχετε την ευχέρεια να σχεδιάσετε τη ΒΔ κατά\r\nβούληση, προσθέτοντας νέους πίνακες ή τροποποιώντας τους παραπάνω, με στόχο την πληρότητα\r\nτων προς αποθήκευση πληροφοριών και την ορθότητα των συσχετίσεων. Σημειωτέον ότι δεν έχουν\r\nσυμπεριληφθεί στην παραπάνω περιγραφή πίνακες και πεδία που προκύπτουν από τις συσχετίσεις\r\nμεταξύ των οντοτήτων', 'ergasia.jpg', 2),
(17, 'Εργασια 1', 'Ο φοιτητής θα πρέπει να είναι σε θέση να επιλέξει μάθημα και εργασία\r\nκαι στη συνέχεια να συμπληρώσει τίτλο και σύντομη περιγραφή και να ανεβάσει το αρχείο (pdf)\r\nμε την εργασία του. Μετά την υποβολή, τα στοιχεία αυτά θα πρέπει να αποθηκεύονται επιτυχώς\r\nστην πλευρά του server.', 'ergasia.jpg', 3),
(18, 'Εργασια 2', 'Βασικός στόχος της συγκεκριμένης άσκησης είναι ο/η φοιτητής/τρια να εξοικειωθεί με βασικές\r\nέννοιες της μηχανικής λογισμικού (software engineering) και, ειδικότερα, με την έννοια του\r\nτεχνικού χρέους (technical debt).', 'ergasia.jpg', 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`) VALUES
(1, 'ΠΛΗ10'),
(2, 'ΠΛΗ20'),
(3, 'ΠΛΗ30'),
(4, 'ΠΛΗ23');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `submitted_assignment`
--

CREATE TABLE `submitted_assignment` (
  `submission_id` int(11) NOT NULL,
  `submission_title` varchar(255) NOT NULL,
  `submission_description` text NOT NULL,
  `submission_file` varchar(255) DEFAULT NULL,
  `submission_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `submitted_assignment`
--

INSERT INTO `submitted_assignment` (`submission_id`, `submission_title`, `submission_description`, `submission_file`, `submission_timestamp`, `user_id`, `assignment_id`) VALUES
(17, 'ΤιτλοςΕργασιας', 'ΠεριγραφηΕργασιας', 'uploads/charamidis_sotirios_ge1_pli23.pdf', '2025-03-26 10:11:59', 18, 17),
(18, 'Test', 'TestDescription', 'uploads/charamidis_sotirios_ge2_pli23.pdf', '2025-03-26 10:18:10', 18, 14),
(19, 'Ergasia mou', 'Perigrafi ergasias m', 'uploads/charamidis_sotirios_ge1_pli23.pdf', '2025-03-26 10:24:09', 18, 13),
(20, 'Η εργασια μου ', 'Περιγραφη της εργασιας μου', 'uploads/charamidis_sotirios_ge2_pli23 (1).pdf', '2025-03-26 11:00:20', 16, 13);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','professor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role`) VALUES
(15, 'sotirisxaram92@gmail.com', 'sotiris', '$2y$10$E0hwwZPmbiv9T9TVWZdyC.e7ls3HxuSB7/9/R2Y9krCP.TJekXUpO', 'professor'),
(16, 'aggeliki@gmail.com', 'aggeliki', '$2y$10$gwXT5oFoh2MbOYJxMAeaweQqxXb/JHnee/VOInfK/fAKo3xJu0lKW', 'student'),
(17, 'kostas@gmail.com', 'kostas', '$2y$10$8GwLH4op9bQIoLQe1R7g0eP5PpG2jURXBbgEyukrFxFVhPoo4MnNS', 'student'),
(18, 'sotos@gmail.com', 'sotos', '$2y$10$wVf3s4QSlh5E8IQTrUImRumxTN/vJu7.xr48mBJ832fjM88yB5DO6', 'student'),
(19, 'maria@gmail.com', 'maria', '$2y$10$tCQObRHiOCI1lv920zBgzO3UJ.xnKBROdY.XwN1USzmcvHuN0Lb.W', 'professor'),
(20, 'gregory@gmail.com', 'gregory', '$2y$10$sUix05J96ic.N45NSkVvoOHw58e3Ou0S9Evw66NGL2IVmPu9iQ3qi', 'professor'),
(21, 'nikos@gmail.com', 'nikos', '$2y$10$BBr20EsxFI2oR1zzFnHo5.P.PoaEbLJdXdskTaaWJS8u4hch.yBxK', 'student'),
(22, 'sofia@gmail.com', 'sofia', '$2y$10$nD6/5RlnOk/JGtWoQQqogebsFLEzxJm1yZBAURuKsoCNKuKQbCLQK', 'student');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `full_name`, `occupation`, `linkedin`, `facebook`, `youtube`, `instagram`, `twitter`) VALUES
(16, 'ANGELIKI', 'ECONOMICS', 'https://www.linkedin.com', 'https://www.facebook.com', 'https://www.youtube.com', 'https://www.instagram.com', 'https://www.x.com'),
(18, 'SOTOS', 'AIA', 'https://www.linkedin.com', 'https://www.facebook.com', 'https://www.youtube.com', 'https://www.instagram.com', 'https://www.x.com'),
(21, 'NIKOS', 'FIREFIGHTER', 'https://www.linkedin.com', 'https://www.facebook.com', 'https://www.youtube.com', '', 'https://www.x.com'),
(22, 'SOFIA', 'Barwoman', 'https://www.linkedin.com', 'https://www.facebook.com', '', 'https://www.instagram.com', '');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `assignment_description`
--
ALTER TABLE `assignment_description`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `fk_assignment_course_idx` (`course_id`);

--
-- Ευρετήρια για πίνακα `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Ευρετήρια για πίνακα `submitted_assignment`
--
ALTER TABLE `submitted_assignment`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `fk_submission_user_idx` (`user_id`),
  ADD KEY `fk_submission_assignment_idx` (`assignment_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Ευρετήρια για πίνακα `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `assignment_description`
--
ALTER TABLE `assignment_description`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `submitted_assignment`
--
ALTER TABLE `submitted_assignment`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `assignment_description`
--
ALTER TABLE `assignment_description`
  ADD CONSTRAINT `fk_assignment_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `submitted_assignment`
--
ALTER TABLE `submitted_assignment`
  ADD CONSTRAINT `fk_submission_assignment` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_description` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
