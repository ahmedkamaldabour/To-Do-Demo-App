<?php
session_start();
include 'inc/val.php';
include 'inc/todo_db.php';

if (empty($_SESSION['login'])) {
    redirect_to('login');
}

$user_id = $_SESSION['login']['id'];
$list_of_todos = get_todos($user_id);

include_once "inc/header.php";
?>
    <table>
        <tr>
            <th>
                <a href="add.php"> ADD New Task </a>
            </th>
            <th>
                <a href="login.php"> logout </a>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Body</th>
            <th></th>
            <th>IMG</th>
            <th>Action</th>

        </tr>
        <?php foreach ($list_of_todos as $key => $todo):
        unset($todo["user_id"], $todo["status"]);
        ?>
        <tr>
            <?php foreach ($todo as $value): ?>
                <td>
                <?php
                if ($todo["img"] === $value) { ?>
                    <td><img src="upload/<?= $value; ?>"></td>
                <?php } else
                    echo $value;
                ?>
                </td>
            <?php endforeach; ?>
            <th>
                <a href="update.php?id=<?= $todo["id"]; ?>"> Edit</a>
                | |
                <a href="delete.php?id=<?= $todo["id"]; ?>&img=<?=$todo["img"]; ?>"> Delete</a>
            </th>
            <?php endforeach; ?>
        </tr>
    </table>
<?php
include_once "inc/footer.php";
?>