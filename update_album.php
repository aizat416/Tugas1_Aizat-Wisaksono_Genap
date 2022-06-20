<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['alb_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $alb_id = isset($_POST['alb_id']) ? $_POST['alb_id'] : NULL;
        $alb_name = isset($_POST['alb_name']) ? $_POST['alb_name'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_album SET alb_id = ?, alb_name = ? WHERE alb_id = ?');
        $stmt->execute([$alb_id, $alb_name, $_GET['alb_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_album WHERE alb_id = ?');
    $stmt->execute([$_GET['alb_id']]);
    $tb_album = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_album) {
        exit('tb_album doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Album #<?=$tb_album['alb_id']?></h2>
    <form action="update_album.php?alb_id=<?=$tb_album['alb_id']?>" method="post">
        <label for="alb_id">ID</label>
        <label for="alb_name">Nama</label>
        <input type="text" name="alb_id" value="<?=$tb_album['alb_id']?>" id="alb_id">
        <input type="text" name="alb_name" value="<?=$tb_album['alb_name']?>" id="alb_name">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>