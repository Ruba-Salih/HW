<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/validation.js"></script>
</head>
<body>
    <header>
        <h1>Book an Appointment</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="book.php">Book Appointment</a></li>
            <li><a href="manage.php">Manage Appointment</a></li>
        </ul>
    </nav>
    <main>
        <section>
            <form id="bookForm" action="../public/index.php" method="post" onsubmit="return validateForm()">
                <label for="patient_name">Patient Name:</label>
                <input type="text" id="patient_name" name="patient_name" required>
                
                <label for="doctor_id">Doctor ID:</label>
                <input type="number" id="doctor_id" name="doctor_id" required>
                
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
                
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                
                <input type="submit" value="Book Appointment">
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Our Clinic. All rights reserved.</p>
    </footer>
</body>
</html>
