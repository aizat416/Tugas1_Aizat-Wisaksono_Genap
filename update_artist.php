<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['art_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $art_id = isset($_POST['art_id']) ? $_POST['art_id'] : NULL;
        $art_name = isset($_POST['art_name']) ? $_POST['art_name'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_artist SET art_id = ?, art_name = ? WHERE art_id = ?');
        $stmt->execute([$art_id, $art_name, $_GET['art_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_artist WHERE art_id = ?');
    $stmt->execute([$_GET['art_id']]);
    $tb_artist = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_artist) {
        exit('tb_artist doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Artist #<?=$tb_artist['art_id']?></h2>
    <form action="update_artist.php?art_id=<?=$tb_artist['art_id']?>" method="post">
        <label for="art_id">ID</label>
        <label for="art_name">Nama</label>
        <input type="text" name="art_id" value="<?=$tb_artist['art_id']?>" id="art_id">
        <input type="text" name="art_name" value="<?=$tb_artist['art_name']?>" id="art_name">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>