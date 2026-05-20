<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = $_SESSION['username'];

$query = mysqli_query($conn, "
    SELECT SUM(score) AS total_score
    FROM user_answers
    WHERE user_id = $userId
");

$data = mysqli_fetch_assoc($query);

$totalScore = $data['total_score'] ?? 0;

if ($totalScore >= 80) {

    $level = "Advanced Beginner";
    $progress = 90;

    $roadmap = [
        ["Backend Fundamentals", true],
        ["Database SQL", true],
        ["Authentication & Session", true],
        ["REST API", true],
        ["Deployment", false]
    ];

} elseif ($totalScore >= 50) {

    $level = "Growing Learner";
    $progress = 65;

    $roadmap = [
        ["Backend Fundamentals", true],
        ["Database SQL", true],
        ["Authentication & Session", false],
        ["REST API", false],
        ["Deployment", false]
    ];

} else {

    $level = "Starter";
    $progress = 35;

    $roadmap = [
        ["Programming Logic", true],
        ["Basic PHP", false],
        ["Database SQL", false],
        ["Authentication", false],
        ["REST API", false]
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Roadmap - Careon</title>

    <link rel="stylesheet" href="assets/careon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<div class="dashboard-layout">

<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-broadcast-pin"></i>
        </div>

        <div>
            <h2>Careon</h2>
        </div>
    </div>

    <a class="side-link" href="dashboard.php">
        <i class="bi bi-grid-fill"></i> Dashboard
    </a>

    <a class="side-link" href="assessment.php">
        <i class="bi bi-shield-check"></i> Career Readiness
    </a>

    <a class="side-link active" href="roadmap.php">
        <i class="bi bi-map"></i> Roadmap
    </a>

    <a class="side-link" href="progress.php">
        <i class="bi bi-graph-up-arrow"></i> Progress
    </a>

    <a class="side-link" href="profile.php">
        <i class="bi bi-person-circle"></i> Profile
    </a>

    <a class="upgrade" href="logout.php">Logout</a>

</aside>

    <main class="main-content">

        <div class="dashboard-top">
            <div>
                <h1>Your Backend Journey</h1>
                <p>Personalized roadmap based on your assessment results.</p>
            </div>
        </div>

        <div class="card-careon roadmap-hero">

            <div class="roadmap-badge">
                <?= $level ?>
            </div>

            <h2>Backend Developer Roadmap</h2>

            <p>
                Based on Careon's assessment, you are currently at level
                <b><?= $level ?></b>.
            </p>

            <div class="progress-wrap">

                <div class="progress-info">
                    <span>Roadmap Progress</span>
                    <b><?= $progress ?>%</b>
                </div>

                <div class="progress-careon">
                    <div class="progress-fill red" style="width: <?= $progress ?>%;"></div>
                </div>

            </div>

        </div>

        <div class="roadmap-grid">

            <?php foreach ($roadmap as $item): ?>

                <div class="roadmap-step <?= $item[1] ? 'done' : 'locked' ?>">

                    <div class="step-icon">
                        <?php if ($item[1]): ?>
                            <i class="bi bi-check-circle-fill"></i>
                        <?php else: ?>
                            <i class="bi bi-lock-fill"></i>
                        <?php endif; ?>
                    </div>

                    <div>
                        <h3><?= $item[0] ?></h3>

                        <p>
                            <?php if ($item[1]): ?>
                                Completed / Ready to Learn
                            <?php else: ?>
                                Locked for next progress
                            <?php endif; ?>
                        </p>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="card-careon mt-4">

            <div class="card-body">

                <div class="section-title mb-3">
                    Recommended Learning
                </div>

                <div class="next-step-list">

                    <div class="next-step-item">
                        Practice CRUD using PHP Native
                    </div>

                    <div class="next-step-item">
                        Learn SQL JOIN & Relationships
                    </div>

                    <div class="next-step-item">
                        Build Login & Authentication System
                    </div>

                    <div class="next-step-item">
                        Try building your first REST API
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>