<?php
include('../partials/side-top.php');
?>

<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    //  if user is not loggedin Redirect to login page
    header('Location: login.php');
    exit(); // Stop further execution
}

$_SESSION['table'] = 'users';
$user = $_SESSION['user'];
$logged_in_users = [$user];
$users = include('../include/add_user/show_users.php');
?>


<div class="dashboard_content_main">
  <div class="dashboard_content">
    <div>
<!-- start -->
<h1 class="section_header"><i class="fa fa-plus"></i>Create User</h1>
          <div class="dashboard_content_main">
            <div id="userAddForm">
              <form action="../include/add_user/user-add.php" 
              method="POST" enctype="multipart/form-data"
              class="appForm" id="userAddForm">
                <div class="appFormInputContainer">
                    <label for="firstName">First Name</label>
                    <input type="text" class="appFormInput" id = "firstName" name="firstName">
                </div>
                <div class="appFormInputContainer">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="appFormInput" id = "lastName" name="lastName">
                </div>
                <div class="appFormInputContainer">
                    <label for="email">Email</label>
                    <input type="text" class="appFormInput" id = "email" name="email">
                </div>
                <div class="appFormInputContainer">
                    <label for="password">Password</label>
                    <input type="password" class="appFormInput" id = "password" name="password" required>
                </div>
                <div class="appFormInputContainer">
                  <label for="level">Access Level</label>
                  <select class="form-select" id="level" name="level">
                      <option value="admin">Admin</option>
                      <option value="staff">Staff</option>
                  </select>
                </div>
                

                <!-- <input type="hidden" name="table" value="asdf"> -->
                <button type="submit" class="appbtn"><i class="fa fa-plus"></i> Add User</button>
               
              </form>
              <?php
              if (isset($_SESSION['response'])) {
                
                $response_message = $_SESSION['response']['message'];
                $is_success = $_SESSION['response']['success'];
                ?>
                
                <div class= "responseMessage">
                  <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'?>">
                      <?= $response_message?>
                  </p>
                </div>
              <?php unset($_SESSION['response']); } ?>
            </div>       
          </div>
    </div>

<!-- table -->
<div>

</div>
<h1 class="section_header"><i class="fa fa-plus"></i>User list</h1>
          <div class="users">
            <p class="userCount"><?= count($users)?>Users</p>
            <table>
              <thead>
                  <tr>
                  <th>id </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Create date</th>
                    <th>Access level</th>
                    <th>Action</th>

                  </tr>
              </thead>
              <tbody>
                <?php
                  foreach($users as $id=> $user){?>
                  <tr>
                  <td><?= $id + 1?></td>
                  <td><?= $user['firstName'] ?></td>
                  <td><?= $user['lastName'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['password'] ?></td>
                  <td><?= date('M d,Y ', strtotime($user['created_at'])) ?></td>
                  <td><?= $user['level'] ?></td>

                  <!-- <td><?= date('M d,Y ', strtotime($user['updated_at'])) ?></td> -->
                  <td>
                    <!-- <a href="../manage/updateUser.php" class="updateUser"><i class="fa fa-pencil">Edit</i></a> -->
                    
                    <a class="btn btn-danger" name = "delete" value = "delete" href = "../include/add_user/deleteUser.php?delete=<?php echo $user['id'];?>"><i class='bx bx-trash'></i>Delete </a></td> 
                    
                  </td>
                </tr>
                  <?php } ?>
                
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
      

    
<?php include('../partials/side-bot.php'); ?>
    
  </body>
</html>
