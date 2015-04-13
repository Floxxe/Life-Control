<?php

// create a database connection, using the constants from config/db.php (which we loaded in index.php)
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// change character set to utf8 and check it
if (!$db_connection->set_charset("utf8")) {
    $db_connection->errors[] = $db_connection->error;
}
$userPid = "";
$curpassHash = "";
?>

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-4">
	</div>
    <div class="col-lg-8">
        <h1 class="page-header">
            <?php echo $lang['navProfile']; ?>
            <small><?php echo " " . $lang['overview']; ?></small>
        </h1>
    </div>
</div>
<!-- /.row -->
<div class="col-lg-4">
</div>
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user_name']; ?> </h3>
        </div>
        <div class="panel-body">
            <?php
            if (!$db_connection->connect_errno) {

                if (!empty($_POST)) {
                    $email = $_POST['email'];
					$user_pic = $_POST['user_pic'];
					
                    $update = "UPDATE `users` SET `user_email`= '" . $email . "', `user_profile`= '" . $user_pic . "'WHERE `user_name` = '" . $_SESSION['user_name'] . "' ";
                    $result_of_query = $db_connection->query($update);
                    $sql = "SELECT * FROM `users` WHERE `user_name` ='" . $_SESSION['user_name'] . "' ;";
                } else {
                    $sql = "SELECT * FROM `users` WHERE `user_name` ='" . $_SESSION['user_name'] . "' ;";
                }
                $sql = "SELECT * FROM `users` WHERE `user_name` ='" . $_SESSION['user_name'] . "' ;";
                $result_of_query = $db_connection->query($sql);
                while ($row = mysqli_fetch_assoc($result_of_query)) {
                    ?>
                    <form method='post' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' name='profileEdit'>
                    <?php
                    $userPid = $row["playerid"];
                    echo "<center>";
                    echo "<h4>" . $lang['emailAdd'] . ": <input style='min-width:300px;text-align:center;'id='email' type='text' name='email' value='" . $row["user_email"] . "'></h4>";
                    echo "<h4>" . $lang['rank'] . ": " . $row["user_level"] . "</h4>";
					echo "<h4> Picture: ";
					echo "<select id='user_pic' name='user_pic'>";
					echo '<option value="assets/img/ui-dave.jpg"';
					if ($row['user_profile'] == "assets/img/ui-dave.jpg") {
						echo ' selected';
					}
					echo '>Dave</option>';
					echo '<option value="assets/img/ui-sam.jpg"';
					if ($row['user_profile'] == "assets/img/ui-sam.jpg") {
						echo ' selected';
					}
					echo '>Sam</option>';
					echo '<option value="assets/img/ui-joe.jpg"';
					if ($row['user_profile'] == "assets/img/ui-joe.jpg") {
						echo ' selected';
					}
					echo '>Joe</option>';
					echo '<option value="assets/img/ui-kerry.jpg"';
					if ($row['user_profile'] == "assets/img/ui-kerry.jpg") {
						echo ' selected';
					}
					echo '>Kerry</option>';
					echo '<option value="assets/img/ui-connie.jpg"';
					if ($row['user_profile'] == "assets/img/ui-connie.jpg") {
						echo ' selected';
					}
					echo '>Connie</option>';
					echo '<option value="assets/img/ui-Jess.jpg"';
					if ($row['user_profile'] == "assets/img/ui-Jess.jpg") {
						echo ' selected';
					}
					echo '>Jess</option>';
					echo '</h4>';
					echo "</select>";
                    echo "<h4>" . $lang['playerID'] . ": " . $row["playerid"] . "</h4>";
                    echo "<input class='btn btn-sm btn-primary'  type='submit'  name='edit' value='" . $lang['subChange'] . "'>";
                    echo "</center>";
                }
            ;
                ?>
                </form>
            <?php
            } else {
                $this->errors[] = "Database connection problem.";
            }
            ?>
        </div>
    </div>
</div>
<!-- /.Profile -->