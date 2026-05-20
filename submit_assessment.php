<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "DELETE FROM user_answers WHERE user_id='$user_id'");
foreach ($_POST['answer'] as $question_id => $chosen_option) {
    $score = ($chosen_option == "A") ? 10 : (($chosen_option == "B") ? 5 : 0);
    $question_id = intval($question_id);
    $chosen_option = mysqli_real_escape_string($conn, $chosen_option);
    mysqli_query($conn, "INSERT INTO user_answers (user_id, question_id, chosen_option, score) VALUES ('$user_id', '$question_id', '$chosen_option', '$score')");
}
header("Location: dashboard.php"); exit;
?>
