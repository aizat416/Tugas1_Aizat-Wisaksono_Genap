<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['ply_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_played WHERE ply_id = ?');
    $stmt->execute([$_GET['ply_id']]);
    $tb_played = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_played) {
        exit('tb_played doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_played WHERE ply_id = ?');
            $stmt->execute([$_GET['ply_id']]);
            $msg = 'You have deleted the tb_played!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_played.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete played #<?=$tb_played['ply_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete played #<?=$tb_played['ply_id']?>?</p>
    <div class="yesno">
        <a href="delete_played.php?ply_id=<?=$tb_played['ply_id']?>&confirm=yes">Yes</a>
        <a href="delete_played.php?ply_id=<?=$tb_played['ply_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>