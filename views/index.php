<?php
  if($user == false){
    ?> 
    <form action="login.php" method="post">
      <input type="text" name="username" value="" placeholder="username" />
      <input type="text" name="password" value="" placeholder="password" />
      <input type="submit" value="�����" />
    </form>
    <?php
  }
  else {
    ?> ������,  <?php echo $user['username']; ?>. <a href="./logout">[�����]</a>
  <?php } ?>