<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $trc_id = isset($_POST['trc_id']) && !empty($_POST['trc_id']) && $_POST['trc_id'] != 'auto' ? $_POST['trc_id'] :  NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $trc_name = isset($_POST['trc_name']) ? $_POST['trc_name'] : '';
    $trc_id_album = isset($_POST['trc_id_album']) && !empty($_POST['trc_id_album']) && $_POST['trc_id_album'] != 'auto' ? $_POST['trc_id_album'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : NULL;

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_track VALUES (?, ?, ?, ?)');
    $stmt->execute([$trc_id, $trc_name, $trc_id_album, $time]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create track</h2>
    <form action="create_track.php" method="post">
        <label for="trc_id">ID</label>
        <label for="trc_name">Nama</label>
        <input type="text" name="trc_id" value="auto" id="trc_id">
        <input type="text" name="trc_name" id="trc_name">
        <label for="trc_id_album">Track Album</label>     
        <label for="time">Time</label>
        <input type="text" name="trc_id_album" id="trc_id_album">
        <input type="text" name="time" value="auto" id="time">
        
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>