<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Tutor</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<p><a href="index.php">&larr; Return to Home</a></p>

	<?php 
	$tutor_id = $_GET['tutor_id'] ?? null;
	$getTutorByID = getTutorByID($pdo, $tutor_id); 
	if (!$getTutorByID) {
		echo "<h1>Tutor not found!</h1>";
		exit();
	}
	?>

	<h1 style="margin-top: 15px;">Edit Tutor Information</h1>
	<form action="core/handleForms.php?tutor_id=<?php echo htmlspecialchars($tutor_id); ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($getTutorByID['first_name']); ?>" required>
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($getTutorByID['last_name']); ?>" required>
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" id="email" value="<?php echo htmlspecialchars($getTutorByID['email']); ?>" required>
		</p>
		<p>
			<label for="phoneNumber">Phone Number</label> 
			<input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo htmlspecialchars($getTutorByID['phone_number']); ?>">
		</p>
		<p>
			<label for="specialization">Specialization</label> 
			<input type="text" name="specialization" id="specialization" value="<?php echo htmlspecialchars($getTutorByID['specialization']); ?>" required>
		</p>
		<p>
			<label for="hourlyRate">Hourly Rate ($/hr)</label> 
			<input type="number" step="0.01" name="hourlyRate" id="hourlyRate" value="<?php echo htmlspecialchars($getTutorByID['hourly_rate']); ?>" required>
		</p>
		<p>
			<input type="submit" name="editTutorBtn" value="Update Tutor">
		</p>
	</form>
</body>
</html>