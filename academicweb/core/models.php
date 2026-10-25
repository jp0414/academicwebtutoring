<?php

	// ============================================================
	// TUTORS (PARENT TABLE) - CRUD Functions
	// ============================================================

	// Get all tutors ordered by date joined
	function getAllTutors($pdo) {
		$sql = "SELECT * FROM tutors ORDER BY date_joined DESC, tutor_id DESC";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Get a single tutor by ID
	function getTutorByID($pdo, $tutor_id) {
		$sql = "SELECT * FROM tutors WHERE tutor_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$tutor_id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Alias for getTutorByID (used in view/header displays)
	function getAllInfoByTutorID($pdo, $tutor_id) {
		return getTutorByID($pdo, $tutor_id);
	}

	// Insert a new tutor
	function insertTutor($pdo, $firstName, $lastName, $email, $phoneNumber, $specialization, $hourlyRate) {
		$sql = "INSERT INTO tutors (first_name, last_name, email, phone_number, specialization, hourly_rate) 
				VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $specialization, $hourlyRate]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}

	// Update tutor details
	function updateTutor($pdo, $tutor_id, $firstName, $lastName, $email, $phoneNumber, $specialization, $hourlyRate) {
		$sql = "UPDATE tutors 
				SET first_name = ?, last_name = ?, email = ?, phone_number = ?, specialization = ?, hourly_rate = ? 
				WHERE tutor_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $specialization, $hourlyRate, $tutor_id]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}

	// Delete a tutor (cascades to delete their sessions)
	function deleteTutor($pdo, $tutor_id) {
		$sql = "DELETE FROM tutors WHERE tutor_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$tutor_id]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}


	// ============================================================
	// SESSIONS (CHILD TABLE) - CRUD Functions
	// ============================================================

	// Get all sessions for a specific tutor with tutor's full name
	function getSessionsByTutor($pdo, $tutor_id) {
		$sql = "SELECT s.*, CONCAT(t.first_name, ' ', t.last_name) AS tutor_name 
				FROM sessions s 
				INNER JOIN tutors t ON s.tutor_id = t.tutor_id 
				WHERE s.tutor_id = ? 
				ORDER BY s.session_date DESC, s.start_time DESC";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$tutor_id]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Get a single session by ID
	function getSessionByID($pdo, $session_id) {
		$sql = "SELECT s.*, CONCAT(t.first_name, ' ', t.last_name) AS tutor_name 
				FROM sessions s 
				INNER JOIN tutors t ON s.tutor_id = t.tutor_id 
				WHERE s.session_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$session_id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Insert a new tutoring session
	function insertSession($pdo, $tutor_id, $sessionDate, $startTime, $endTime, $subjectTaught, $notes) {
		$sql = "INSERT INTO sessions (tutor_id, session_date, start_time, end_time, subject_taught, notes) 
				VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$tutor_id, $sessionDate, $startTime, $endTime, $subjectTaught, $notes]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}

	// Update an existing tutoring session
	function updateSession($pdo, $session_id, $sessionDate, $startTime, $endTime, $subjectTaught, $notes) {
		$sql = "UPDATE sessions 
				SET session_date = ?, start_time = ?, end_time = ?, subject_taught = ?, notes = ? 
				WHERE session_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$sessionDate, $startTime, $endTime, $subjectTaught, $notes, $session_id]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}

	// Delete a session
	function deleteSession($pdo, $session_id) {
		$sql = "DELETE FROM sessions WHERE session_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$session_id]);

		if ($executeQuery) {
			return true;
		}
		return false;
	}

?>
