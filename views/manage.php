<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointment</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Appointments</h1>
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
            <h2>Current Appointments</h2>
            <table id="appointments">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor ID</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- JavaScript will populate this table with appointment data -->
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Our Clinic. All rights reserved.</p>
    </footer>
    <script src="../js/manage.js"></script>
</body>
</html>
