<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['trc_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_track WHERE trc_id = ?');
    $stmt->execute([$_GET['trc_id']]);
    $tb_track = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_track) {
        exit('tb_track doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_track WHERE trc_id = ?');
            $stmt->execute([$_GET['trc_id']]);
            $msg = 'You have deleted the tb_track!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_track.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete track #<?=$tb_track['trc_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete track #<?=$tb_track['trc_id']?>?</p>
    <div class="yesno">
        <a href="delete_track.php?trc_id=<?=$tb_track['trc_id']?>&confirm=yes">Yes</a>
        <a href="delete_track.php?trc_id=<?=$tb_track['trc_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>