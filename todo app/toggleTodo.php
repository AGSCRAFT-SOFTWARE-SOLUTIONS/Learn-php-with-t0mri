<?php
include("db.php");

if (!empty($_POST)) {
    foreach ($_POST as $id => $status) {
        $status = $status == "on" ? 1 : 0;

        // Updating the status of the todoes on the database
        $db->query("update todos set status='{$status}' where id='{$id}'");
    }
}

// Query to retrieve all todos
$query = "select * from todos";

// Querying data with mysqli (for both oo and procedual way)
// $todos = $db->query($query)->fetch_all(MYSQLI_ASSOC);

// Querying data with PDO
$todos = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Completed todos section -->
<form id="notCompletedForm" action="/todo app/toggleTodo.php" method="post" hx-boost="true" hx-push-url="false" hx-target="#completedForm" hx-trigger="change" hx-swap-oob="true">
    <?php foreach ($todos as $todo) : ?>
        <?php if ($todo["status"] == 0) : ?>
            <input type="checkbox" name="<?php echo $todo["id"] ?>" id="">
            <label for="<?php echo $todo["id"] ?>"><?php echo $todo["todo"] ?></label>
            <br>
        <?php endif; ?>
    <?php endforeach; ?>
</form>

<!-- Uncompleted todos section -->
<form id="completedForm" action="/todo app/toggleTodo.php" method="post" hx-boost="true" hx-push-url="false" hx-target="#notCompletedForm" hx-trigger="change" hx-swap-oob="true">
    <?php foreach ($todos as $todo) : ?>
        <?php if ($todo["status"] == 1) : ?>
            <input type="hidden" name="<?php echo $todo["id"] ?>">
            <input type="checkbox" name="<?php echo $todo["id"] ?>" checked class="op-50">
            <label for="<?php echo $todo["id"] ?>" class="op-50"><s><?php echo $todo["todo"] ?></s></label>
            <br>
        <?php endif; ?>
    <?php endforeach; ?>
</form>