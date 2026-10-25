<?php

require_once 'dbConfig.php';
require_once 'models.php';

// ============================================================
// TUTOR HANDLING (PARENT TABLE)
// ============================================================

// Insert a new Tutor
if (isset($_POST['insertTutorBtn'])) {

	$query = insertTutor(
		$pdo,
		$_POST['firstName'],
		$_POST['lastName'],
		$_POST['email'],
		$_POST['phoneNumber'],
		$_POST['specialization'],
		$_POST['hourlyRate']
	);

	if ($query) {
		header("Location: ../index.php");
		exit();
	} else {
		echo "Insertion failed";
	}
}

// Edit an existing Tutor
if (isset($_POST['editTutorBtn'])) {

	$query = updateTutor(
		$pdo,
		$_GET['tutor_id'],
		$_POST['firstName'],
		$_POST['lastName'],
		$_POST['email'],
		$_POST['phoneNumber'],
		$_POST['specialization'],
		$_POST['hourlyRate']
	);

	if ($query) {
		header("Location: ../index.php");
		exit();
	} else {
		echo "Edit failed";
	}
}

// Delete a Tutor
if (isset($_POST['deleteTutorBtn'])) {

	$query = deleteTutor($pdo, $_GET['tutor_id']);

	if ($query) {
		header("Location: ../index.php");
		exit();
	} else {
		echo "Deletion failed";
	}
}


// ============================================================
// SESSION HANDLING (CHILD TABLE)
// ============================================================

// Insert a new Session under a specific Tutor
if (isset($_POST['insertSessionBtn']) || isset($_POST['insertNewSessionBtn'])) {

	$query = insertSession(
		$pdo,
		$_GET['tutor_id'],
		$_POST['sessionDate'],
		$_POST['startTime'],
		$_POST['endTime'],
		$_POST['subjectTaught'],
		$_POST['notes']
	);

	if ($query) {
		header("Location: ../viewtutors.php?tutor_id=" . $_GET['tutor_id']);
		exit();
	} else {
		echo "Insertion failed";
	}
}

// Edit an existing Session
if (isset($_POST['editSessionBtn'])) {

	$query = updateSession(
		$pdo,
		$_GET['session_id'],
		$_POST['sessionDate'],
		$_POST['startTime'],
		$_POST['endTime'],
		$_POST['subjectTaught'],
		$_POST['notes']
	);

	if ($query) {
		header("Location: ../viewtutors.php?tutor_id=" . $_GET['tutor_id']);
		exit();
	} else {
		echo "Update failed";
	}
}

// Delete a Session
if (isset($_POST['deleteSessionBtn'])) {

	$query = deleteSession($pdo, $_GET['session_id']);

	if ($query) {
		header("Location: ../viewtutors.php?tutor_id=" . $_GET['tutor_id']);
		exit();
	} else {
		echo "Deletion failed";
	}
}

?>