<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = (int) $_SESSION['user_id'];

$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
$user = mysqli_fetch_assoc($userQuery);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $status    = mysqli_real_escape_string($conn, $_POST['status']);
    $password  = $_POST['password'];

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn, "
            UPDATE users SET
            first_name = '$firstName',
            last_name = '$lastName',
            username = '$username',
            status = '$status',
            password = '$hashed'
            WHERE id = $userId
        ");
    } else {
        mysqli_query($conn, "
            UPDATE users SET
            first_name = '$firstName',
            last_name = '$lastName',
            username = '$username',
            status = '$status'
            WHERE id = $userId
        ");
    }

    $_SESSION['username'] = $username;
    $message = "Profile berhasil diperbarui.";

    $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
    $user = mysqli_fetch_assoc($userQuery);
}

$firstName = $user['first_name'] ?? '';
$lastName = $user['last_name'] ?? '';
$displayName = trim($firstName . ' ' . $lastName);

if ($displayName == '') {
    $displayName = $user['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - Careon</title>
    <link rel="stylesheet" href="assets/careon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-broadcast-pin"></i></div>
            <div>
                <h2>Careon</h2>
            </div>
        </div>

        <a class="side-link active" href="dashboard.php"><i class="bi bi-grid-fill"></i> Dashboard</a>
        <a class="side-link" href="assessment.php"><i class="bi bi-shield-check"></i> Career Readiness</a>
        <a class="side-link" href="#"><i class="bi bi-map"></i> Roadmap</a>
        <a class="side-link" href="#"><i class="bi bi-graph-up-arrow"></i> Progress</a>
        <a class="side-link" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a>

        <a class="upgrade" href="logout.php">Logout</a>
    </aside>

    <main class="main-content">

        <div class="profile-page">

            <div class="profile-card-left">
                <div class="profile-photo">
                    <?= strtoupper(substr($displayName, 0, 2)); ?>
                </div>

                <h2><?= htmlspecialchars($displayName); ?></h2>
                <p><?= htmlspecialchars($user['status'] ?? 'Backend Developer Candidate'); ?></p>

                <div class="profile-info-box">
                    <span>Email / Username</span>
                    <b><?= htmlspecialchars($user['username']); ?></b>
                </div>

                <div class="profile-info-box">
                    <span>Account Created</span>
                    <b><?= date('F j, Y', strtotime($user['created_at'])); ?></b>
                </div>
            </div>

            <div class="profile-form-card">
                <h1>Edit Profile</h1>
                <p class="form-subtitle">Complete your Careon profile data</p>

                <?php if ($message): ?>
                    <div class="success-alert"><?= $message; ?></div>
                <?php endif; ?>

                <form method="POST">

                    <div class="form-row">
                        <div class="form-group-careon">
                            <label>First name</label>
                            <input type="text" name="first_name" placeholder="Naila"
                                   value="<?= htmlspecialchars($firstName); ?>">
                        </div>

                        <div class="form-group-careon">
                            <label>Last Name</label>
                            <input type="text" name="last_name" placeholder="Amelia"
                                   value="<?= htmlspecialchars($lastName); ?>">
                        </div>
                    </div>

                    <div class="form-group-careon">
                        <label>Email / Username</label>
                        <input type="text" name="username" required
                               value="<?= htmlspecialchars($user['username']); ?>">
                    </div>

                    <div class="form-group-careon">
                        <label>Status</label>
                        <select name="status">
                            <option value="">Choose your status</option>
                            <option value="College Student" <?= ($user['status'] ?? '') == 'College Student' ? 'selected' : ''; ?>>College Student</option>
                            <option value="High school students" <?= ($user['status'] ?? '') == 'High school students' ? 'selected' : ''; ?>>High school students</option>
                            <option value="Fresh Graduate" <?= ($user['status'] ?? '') == 'Fresh Graduate' ? 'selected' : ''; ?>>Fresh Graduate</option>
                            <option value="Career Switcher" <?= ($user['status'] ?? '') == 'Career Switcher' ? 'selected' : ''; ?>>Career Switcher</option>
                        </select>
                    </div>

                    <div class="form-group-careon">
                        <label>Password Baru</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <button type="submit" class="btn-careon-primary">Save Changes</button>
                    <a href="dashboard.php" class="btn-careon-outline">Back to Dashboard</a>

                </form>
            </div>

        </div>

    </main>
</div>

</body>
</html>