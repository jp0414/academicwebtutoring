<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Tutor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <p><a href="index.php">&larr; Return to Home</a></p>

    <?php 
    $tutor_id = $_GET['tutor_id'] ?? null;
    $tutor = getTutorByID($pdo, $tutor_id); 
    if (!$tutor) {
        echo "<h1>Tutor not found!</h1>";
        exit();
    }
    ?>

    <h1 style="color: var(--danger); margin-top: 15px;">Are you sure you want to delete this tutor?</h1>
    <p style="color: var(--text-muted); margin-bottom: 20px;">Warning: Deleting this tutor will also delete all associated tutoring sessions.</p>

    <div class="container">
        <h2>Tutor Name: <?php echo htmlspecialchars($tutor['first_name'] . ' ' . $tutor['last_name']); ?></h2>
        <h2>Email: <?php echo htmlspecialchars($tutor['email']); ?></h2>
        <h2>Phone Number: <?php echo htmlspecialchars($tutor['phone_number'] ?: 'N/A'); ?></h2>
        <h2>Specialization: <?php echo htmlspecialchars($tutor['specialization']); ?></h2>
        <h2>Hourly Rate: $<?php echo htmlspecialchars(number_format($tutor['hourly_rate'], 2)); ?></h2>
        <h2>Date Joined: <?php echo htmlspecialchars($tutor['date_joined']); ?></h2>

        <div class="deleteBtn">
            <form action="core/handleForms.php?tutor_id=<?php echo htmlspecialchars($tutor_id); ?>" method="POST" style="background: none; border: none; padding: 0; box-shadow: none; margin: 0;">
                <input type="submit" name="deleteTutorBtn" value="Delete Tutor">
            </form>
        </div>
    </div>
</body>
</html>