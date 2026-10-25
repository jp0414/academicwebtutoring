<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Academic Web Tutoring Management System</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<h1>Welcome To Academic Web Tutoring Management System. Add New Tutor!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" id="firstName" required>
		</p>
		<p>
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" required>
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" name="email" id="email" required>
		</p>
		<p>
			<label for="phoneNumber">Phone Number</label>
			<input type="text" name="phoneNumber" id="phoneNumber">
		</p>
		<p>
			<label for="specialization">Specialization</label>
			<input type="text" name="specialization" id="specialization" placeholder="e.g. Math, Physics, Web Dev"
				required>
		</p>
		<p>
			<label for="hourlyRate">Hourly Rate (PHP)</label>
			<input type="number" step="0.01" name="hourlyRate" id="hourlyRate" placeholder="e.g. 50.00" required>
		</p>
		<p>
			<input type="submit" name="insertTutorBtn" value="Add Tutor">
		</p>
	</form>

	<h2>All Registered Tutors</h2>

	<?php $getAllTutors = getAllTutors($pdo); ?>
	<?php if (empty($getAllTutors)) { ?>
		<p style="color: var(--text-muted); margin-top: 15px;">No tutors registered yet.</p>
	<?php } ?>

	<?php foreach ($getAllTutors as $row) { ?>
		<div class="container">
			<h3>Tutor Name: <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h3>
			<h3>Email: <?php echo htmlspecialchars($row['email']); ?></h3>
			<h3>Phone: <?php echo htmlspecialchars($row['phone_number'] ?: 'N/A'); ?></h3>
			<h3>Specialization: <?php echo htmlspecialchars($row['specialization']); ?></h3>
			<h3>Hourly Rate: $<?php echo htmlspecialchars(number_format($row['hourly_rate'], 2)); ?></h3>
			<h3>Date Joined: <?php echo htmlspecialchars($row['date_joined']); ?></h3>

			<div class="editAndDelete">
				<a href="viewtutors.php?tutor_id=<?php echo $row['tutor_id']; ?>">View Sessions</a>
				<a href="edittutors.php?tutor_id=<?php echo $row['tutor_id']; ?>">Edit</a>
				<a href="deletetutors.php?tutor_id=<?php echo $row['tutor_id']; ?>">Delete</a>
			</div>
		</div>
	<?php } ?>
</body>

</html>