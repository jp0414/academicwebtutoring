<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Tutoring Session</title>
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

	<h1 style="margin-top: 15px;">Edit Tutoring Session</h1>
	<form action="core/handleForms.php?session_id=<?php echo htmlspecialchars($session_id); ?>&tutor_id=<?php echo htmlspecialchars($tutor_id); ?>" method="POST">
		<p>
			<label for="subjectTaught">Subject Taught</label> 
			<input type="text" name="subjectTaught" id="subjectTaught" value="<?php echo htmlspecialchars($session['subject_taught']); ?>" required>
		</p>
		<p>
			<label for="sessionDate">Session Date</label> 
			<input type="date" name="sessionDate" id="sessionDate" value="<?php echo htmlspecialchars($session['session_date']); ?>" required>
		</p>
		<p>
			<label for="startTime">Start Time</label> 
			<input type="time" name="startTime" id="startTime" value="<?php echo htmlspecialchars($session['start_time']); ?>" required>
		</p>
		<p>
			<label for="endTime">End Time</label> 
			<input type="time" name="endTime" id="endTime" value="<?php echo htmlspecialchars($session['end_time']); ?>" required>
		</p>
		<p>
			<label for="notes">Notes</label> 
			<input type="text" name="notes" id="notes" value="<?php echo htmlspecialchars($session['notes']); ?>">
		</p>
		<p>
			<input type="submit" name="editSessionBtn" value="Update Session">
		</p>
	</form>
</body>
</html>