<?php

include_once 'include.php';


$token=htmlspecialchars($_SESSION['token']);

if (isset($_SESSION['token']) AND isset($token) AND !empty($_SESSION['token']) AND !empty($token)) {

    if ($_SESSION['token'] == $_POST['token']){
      if (isset($_POST['form'])){
        $receiver=htmlspecialchars($_POST['to'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
        $content=htmlspecialchars($_POST['content'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
        $subject=htmlspecialchars($_POST['subjet'],ENT_COMPAT | ENT_HTML5 |ENT_QUOTES);
          if(insertmsg($_SESSION['id_user'],$receiver,$content,$subject)==1){
              $msg="Message has been sent";
          }else{
              $msg="A problem has occured";
          }
        }

  }
}

?>


<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="sendmessage">
        <div class="fieldset">
          <div class="fieldset_label">
            <h1>Send a message</h1>
          </div>
          <div class="field">
            <label>To </label>
            <select name="to" class="form-control" required>
              <?php
              $row=HasTheRighttoSendtoo()->fetchAll();
                foreach ($row as $id => $user) {
                  if($user['id_user']!=$_SESSION['id_user']){
                  echo '<option value="' . $user['id_user'] . '">' . $user['nom'] . ' ' . $user['prenom'] . '</option>';
                  }
                }



              ?>
            </select>
          </div>
          <div class="field">
            <label>Sujet : </label><input type="text" size="20" name="subjet"  required class="form-control">
          </div>
          <div class="field">
            <label>Message </label>
            <textarea class=form-control name="content" rows="4"></textarea>
            <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR'];?>" name="message"/>
            <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
          </div>
          <button type="submit" name="form" class="btn btn-primary" >Send</button>
          <?php

          ?>



          </div>
    </form>
    <div>
      <span class="text-info"><?php if (isset($msg)) { echo $msg; } ?></span>
    </div>

    <div class="container-fluid" id="info">
        <ul class="nav navbar-nav navbar-center">
            <button class="btn btn-primary" onclick="window.location.href = 'message.php';">Your Messages</button>
        </ul>
    </div>
