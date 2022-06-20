<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['art_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_artist WHERE art_id = ?');
    $stmt->execute([$_GET['art_id']]);
    $tb_artist = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_artist) {
        exit('tb_artist doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_artist WHERE art_id = ?');
            $stmt->execute([$_GET['art_id']]);
            $msg = 'You have deleted the tb_artis!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_artist.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Artist #<?=$tb_artist['art_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete Artist #<?=$tb_artist['art_id']?>?</p>
    <div class="yesno">
        <a href="delete_artist.php?art_id=<?=$tb_artist['art_id']?>&confirm=yes">Yes</a>
        <a href="delete_artist.php?art_id=<?=$tb_artist['art_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>