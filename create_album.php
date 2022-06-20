<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $alb_id = isset($_POST['alb_id']) && !empty($_POST['alb_id']) && $_POST['alb_id'] != 'auto' ? $_POST['alb_id'] : NULL;
    $alb_id_artist = isset($_POST['alb_id_artist']) && !empty($_POST['alb_id_artist']) && $_POST['alb_id_artist'] != 'auto' ? $_POST['alb_id_artist_id'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $alb_name = isset($_POST['alb_name']) ? $_POST['alb_name'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_album VALUES (?, ?, ?)');
    $stmt->execute([$alb_id, $alb_id_artist, $alb_name]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Album</h2>
    <form action="create_album.php" method="post">
        <label for="alb_id">ID</label>
        <label for="alb_id_artist">ID Artist</label>
        <input type="text" name="alb_id" value="auto" id="alb_id">
        <input type="text" name="alb_id_artist" value="auto" id="alb_id_artist">
        <label for="alb_name">Nama</label>
        <input type="text" name="alb_name" id="alb_name">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>