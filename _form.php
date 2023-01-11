<?php
$button = "ADD";
if (basename($_SERVER['PHP_SELF']) == "update.php"){
    $button = "UPDATE";
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo $row["title"] ?? ""; ?>">
    <label for="body">Body</label>
    <textarea name="body"><?php echo $row["body"] ?? ""; ?> </textarea>
    <?php if (basename($_SERVER['PHP_SELF']) == "update.php"): ?>
    <img width="100px" src="upload/<?= $row["img"]; ?>">
    <?php endif; ?>
    <br />
    <label for="file">Chose img</label>
    <input type="file" name="img">
    <input type="hidden" value="<?= $row['id']; ?>" name="id">
    <button type="submit" name="save""> <?=$button?></button>
</form>
