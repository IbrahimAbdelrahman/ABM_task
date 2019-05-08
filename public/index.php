<?php

require_once('../private/initialize.php');


?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <div class="admins listing">
    <h1>Index Page</h1>

    <h2>Modal Example: click the button</h2>
    <button id="myBtn">Add User</button>
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <form id="foo">
            Name:
            <input id="name" name="name" type="text" value="" />
            <br>
            Age:
            <input id="age" name="age" type="number" value="" />
            <br>
            <input type="submit" value="Send" />
        </form>
      </div>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
      </tr>
    <?Php 
        $users = User::find_all();
    ?>

    <?php foreach($users as $user) { ?>
        <tr>
          <td><?php echo h($user->id); ?></td>
          <td><?php echo h($user->name); ?></td>
          <td><?php echo h($user->age); ?></td>
         
      <?php }  ?>  
    </table>

    <?php /*
      mysqli_free_result($admin_set);
      */
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
