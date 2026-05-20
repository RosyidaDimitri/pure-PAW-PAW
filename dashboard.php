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
    $status = "Sangat Cocok";
    $desc = "Kamu memiliki kecocokan tinggi untuk menjadi Backend Developer.";
    $progress = 90;
    $level = "Advanced Beginner";
} elseif ($totalScore >= 50) {
    $status = "Cukup Cocok";
    $desc = "Kamu cukup cocok, tetapi masih perlu memperkuat database, API, logic, dan server.";
    $progress = 65;
    $level = "Growing Learner";
} elseif ($totalAnswer > 0) {
    $status = "Kurang Cocok";
    $desc = "Kamu masih perlu memperkuat dasar pemrograman backend dari awal.";
    $progress = 35;
    $level = "Starter";
} else {
    $status = "Belum Mengisi Assessment";
    $desc = "Mulai assessment untuk mengetahui kecocokanmu sebagai Backend Developer.";
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
                <p>SOPHISTICATED CO-PILOT</p>
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

        <div class="topbar">
            <input type="text" placeholder="Search resources..." readonly>

            <a href="profile.php" class="profile-pill">
                <span><?= strtoupper(substr($displayName, 0, 2)); ?></span>
                <div>
                    <b><?= htmlspecialchars($firstName); ?></b>
                    <small>View Profile</small>
                </div>
            </a>
        </div>

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
                <div class="card-body text-center py-5">
                    <div class="result-emoji">🎯</div>
                    <p class="mini-label">Backend Developer Readiness</p>
                    <h2><?= $status ?></h2>
                    <p class="result-desc"><?= $desc ?></p>

                    <div class="progress-wrap">
                        <div class="progress-info">
                            <span>Readiness Progress</span>
                            <b><?= $progress ?>%</b>
                        </div>

                        <div class="progress-careon">
                            <div class="progress-fill red" style="width: <?= $progress ?>%;"></div>
                        </div>
                    </div>

                    <div class="level-box">
                        Current Level: <b><?= $level ?></b>
                    </div>

                    <br>

                    <a href="assessment.php" class="btn-careon-primary">
                        <?= $totalAnswer > 0 ? 'Retake Assessment' : 'Start Assessment' ?>
                    </a>
                </div>
            </div>

            <div>
                <div class="card-careon mb-3">
                    <div class="card-body">
                        <div class="section-title mb-3">Recommended Next Steps</div>

                        <?php if ($totalAnswer == 0): ?>
                            <div class="empty-state">
                                <i class="bi bi-clipboard-check"></i>
                                <p>Belum ada hasil assessment.</p>
                                <a href="assessment.php" class="btn-careon-primary btn-careon-sm">Start Now</a>
                            </div>
                        <?php else: ?>
                            <div class="next-step-list">
                                <div class="next-step-item">Pelajari dasar SQL dan relasi tabel</div>
                                <div class="next-step-item">Latihan CRUD dengan PHP Native</div>
                                <div class="next-step-item">Pahami login, session, dan password hash</div>
                                <div class="next-step-item">Coba buat API sederhana</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </main>

</div>

</body>
</html>