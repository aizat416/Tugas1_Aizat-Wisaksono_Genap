<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['ply_id'])) {
    if (!empty($_POST)) {
        // This pply is similar to the create.php, but instead we update a record and not insert
        $ply_id = isset($_POST['ply_id']) ? $_POST['ply_id'] : NULL;
        $ply_id_track = isset($_POST['ply_id_track']) ? $_POST['ply_id_track'] :'';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_played SET ply_id = ?, ply_id_track = ? WHERE ply_id = ?');
        $stmt->execute([$ply_id, $ply_id_track, $_GET['ply_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_played WHERE ply_id = ?');
    $stmt->execute([$_GET['ply_id']]);
    $tb_played = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_played) {
        exit('tb_played doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update played #<?=$tb_played['ply_id']?></h2>
    <form action="update_played.php?ply_id=<?=$tb_played['ply_id']?>" method="post">
        <label for="ply_id">ID</label>
        <label for="ply_id_track">Ply Track</label>
        <input type="text" name="ply_id" value="<?=$tb_played['ply_id']?>" id="ply_id">
        <input type="text" name="ply_id_track" value="<?=$tb_played['ply_id_track']?>" id="ply_id_track">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>