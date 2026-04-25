<?php 
$connect  = new mysqli("localhost","root","","mini_pinterest");
$id = $_GET['id'];
$sql = "SELECT *FROM posts WHERE id=$id";
$result = $connect->query($sql);
$row = $result->fetch_assoc();
$board=$connect->query("SELECT * FROM boards");
if(isset($_POST['board'])){
    $board_id=$_POST['board'];
    $check = "SELECT * FROM saved_pins WHERE post_id=$id AND board_id=$board_id";
    $res = $connect->query($check);
    if($res->num_rows > 0){
        echo "pffts... you already have  saved this silly!";

    }
    else{
        $insert="INSERT INTO saved_pins(post_id,board_id) VALUES($id,$board_id)";
        $connect->query($insert);
        echo "saved! ⭐";
    } }


?>
<!DOCTYPE html>
<html>
    
    <body>
        <section>
            <nav>
                <ul class="nv">
                    <li><a href="home_page.php">RETURN</a></li>
                </ul>
            </nav>
        </section>
        <form method="post">
        <div>
             <select name="board" onchange="this.form.submit()">
                <option selected>Save</option>
                 <?php while($b = $board->fetch_assoc()){?>
                    <option value="<?php echo $b['id']; ?>">
                    <?php echo $b['name']; ?>
                    </option>
                 <?php } ?> 
              </select>
            <img src="<?php echo $row['image']; ?>" width="400">
            <p><?php echo $row['description']; ?></p>
          

        </div>
        </form>
    </body>
</html>