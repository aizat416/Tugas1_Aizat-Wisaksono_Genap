<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['trc_id'])) {
    if (!empty($_POST)) {
        // This ptrc is similar to the create.php, but instead we update a record and not insert
        $trc_id = isset($_POST['trc_id']) ? $_POST['trc_id'] : NULL;
        $trc_name = isset($_POST['trc_name']) ? $_POST['trc_name'] : '';
        $trc_id_album = isset($_POST['trc_id_album']) ? $_POST['trc_id_album'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_track SET trc_id = ?, trc_name = ? WHERE trc_id = ?');
        $stmt->execute([$trc_id, $trc_name, $_GET['trc_id']]);
        $msg = 'Updated Successfully!';

    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_track WHERE trc_id = ?');
    $stmt->execute([$_GET['trc_id']]);
    $tb_track = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_track) {
        exit('tb_track doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Track #<?=$tb_track['trc_id']?></h2>
    <form action="update_track.php?trc_id=<?=$tb_track['trc_id']?>" method="post">
        <label for="trc_id">ID</label>
        <label for="trc_name">Nama</label>
        <input type="text" name="trc_id" value="<?=$tb_track['trc_id']?>" id="trc_id">
        <input type="text" name="trc_name" value="<?=$tb_track['trc_name']?>" id="trc_name">
        <label for="trc_id_album">No Album</label>
        <input type="text" name="trc_id_album" value="<?=$tb_track['trc_id_album']?>" id="trc_id_album">
        <label for="time">Durasi</label>
        <input type="text" name="time" value="<?=$tb_track['time']?>" id="time">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>