<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Tutoring Session</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php 
	$session_id = $_GET['session_id'] ?? null;
	$tutor_id = $_GET['tutor_id'] ?? null;
	$session = getSessionByID($pdo, $session_id); 
	if (!$session) {
		echo "<h1>Session not found!</h1>";
		exit();
	}
	?>

	<p><a href="viewtutors.php?tutor_id=<?php echo htmlspecialchars($tutor_id); ?>">&larr; Return to Tutoring Sessions</a></p>

	<h1 style="color: var(--danger); margin-top: 15px;">Are you sure you want to delete this tutoring session?</h1>
	
	<div class="container">
		<h2>Subject Taught: <?php echo htmlspecialchars($session['subject_taught']); ?></h2>
		<h2>Session Date: <?php echo htmlspecialchars($session['session_date']); ?></h2>
		<h2>Time: <?php echo htmlspecialchars(date("g:i A", strtotime($session['start_time'])) . ' - ' . date("g:i A", strtotime($session['end_time']))); ?></h2>
		<h2>Tutor: <?php echo htmlspecialchars($session['tutor_name']); ?></h2>
		<h2>Notes: <?php echo htmlspecialchars($session['notes'] ?: 'None'); ?></h2>

		<div class="deleteBtn">
			<form action="core/handleForms.php?session_id=<?php echo htmlspecialchars($session_id); ?>&tutor_id=<?php echo htmlspecialchars($tutor_id); ?>" method="POST" style="background: none; border: none; padding: 0; box-shadow: none; margin: 0;">
				<input type="submit" name="deleteSessionBtn" value="Delete Session">
			</form>
		</div>	
	</div>
</body>
</html>
