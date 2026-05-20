<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = (int) $_SESSION['user_id'];
$displayName = $_SESSION['username'];
$firstName = explode(' ', $displayName)[0];

$assessmentQuery = mysqli_query($conn, "
    SELECT SUM(score) AS total_score, COUNT(*) AS total_answer
    FROM user_answers
    WHERE user_id = $userId
");

$assessment = mysqli_fetch_assoc($assessmentQuery);

$totalScore = $assessment['total_score'] ?? 0;
$totalAnswer = $assessment['total_answer'] ?? 0;

if ($totalScore >= 80) {
    $status = "Very suitable";
    $desc = "You have a high suitability to be a Backend Developer.";
    $progress = 90;
    $level = "Advanced Beginner";
} elseif ($totalScore >= 50) {
    $status = "Suitable enough";
    $desc = "You are quite suitable, but still need to strengthen the database, API, logic, and server.";
    $progress = 65;
    $level = "Growing Learner";
} elseif ($totalAnswer > 0) {
    $status = "Not suitable";
    $desc = "You still need to strengthen the basics of backend programming from the beginning.";
    $progress = 35;
    $level = "Starter";
} else {
    $status = "Haven't filled out the assessment yet";
    $desc = "Start the assessment to find out your suitability as a Backend Developer.";
    $progress = 0;
    $level = "Not Started";
}

$hour = (int)date('H');

if ($hour < 12) {
    $greeting = 'Good morning';
} elseif ($hour < 17) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}

$today = date('l, F j, Y');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Careon</title>
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
        <a class="side-link" href="roadmap.php">
            <i class="bi bi-map"></i> Roadmap
        </a>
        <a class="side-link" href="#"><i class="bi bi-graph-up-arrow"></i> Progress</a>
        <a class="side-link" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a>

        <a class="upgrade" href="logout.php">Logout</a>
    </aside>

    <main class="main-content">
        <div class="dashboard-top">
            <div>
                <h1><?= $greeting ?>, <?= htmlspecialchars($firstName); ?>!</h1>
                <p><?= $today ?></p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card clean-stat">
                <div class="stat-icon blue"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-label">Questions Answered</div>
                    <div class="stat-value"><?= $totalAnswer ?><span>/10</span></div>
                </div>
            </div>

            <div class="stat-card clean-stat">
                <div class="stat-icon red"><i class="bi bi-bar-chart"></i></div>
                <div>
                    <div class="stat-label">Assessment Score</div>
                    <div class="stat-value"><?= $totalScore ?><span>/100</span></div>
                </div>
            </div>

            <div class="stat-card clean-stat">
                <div class="stat-icon navy"><i class="bi bi-code-slash"></i></div>
                <div>
                    <div class="stat-label">Career Match</div>
                    <div class="stat-value"><?= $progress ?><span>%</span></div>
                </div>
            </div>

            <div class="stat-card clean-stat">
                <div class="stat-icon red"><i class="bi bi-laptop"></i></div>
                <div>
                    <div class="stat-label">Recommended Role</div>
                    <div class="stat-value role-text">Backend</div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">

            <div class="card-careon assessment-result-card">
                <div class="card-body result-content">
                    <div class="result-header-row">
                        <div>
                            <p class="mini-label" style="color:rgba(255,255,255,0.68);">
                                Backend Developer Readiness
                            </p>

                            <h2 style="color:white;">
                                <?= $status ?>
                            </h2>

                            <p class="result-desc" style="color:rgba(255,255,255,0.88);">
                                <?= $desc ?>
                            </p>
                        </div>
                    </div>

                    <div class="result-footer-row">
                        <div class="level-box">
                            Current Level: <b><?= $level ?></b>
                        </div>

                        <a href="interest.php" class="btn-careon-primary">
                            Retake Assessment
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-careon mb-3">
                <div class="card-body">
                    <div class="section-title mb-3">Recommended Next Steps</div>

                    <?php if ($totalAnswer == 0): ?>
                        <div class="empty-state">
                            <i class="bi bi-clipboard-check"></i>
                            <p>No assessment result yet.</p>
                            <a href="interest.php" class="btn-careon-primary btn-careon-sm">Start Now</a>
                        </div>
                    <?php else: ?>
                        <div class="next-step-list">
                            <div class="next-step-item">Practice CRUD using PHP Native</div>
                            <div class="next-step-item">Learn SQL JOIN & Relationships</div>
                            <div class="next-step-item">Build Login & Authentication System</div>
                            <div class="next-step-item">Try building your first REST API</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>

</div>

</body>
</html>