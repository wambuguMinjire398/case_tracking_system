<div class="sidebar">
      <div class="top">
        <div class="logo">
          <i class="bx bxl-codepen"></i>
          <span>CMS</span>
        </div>
        <i class="bx bx-menu" id="btn"></i>
      </div>

      <div class="user">
        <img src="../images/user/brian.JPG" alt="me" class="use-img" />
        <div>
        <span><?= $user['firstName']. ' ' . $user['lastName']?></span>
          <p>Admin</p>
        </div>
      </div>
      <ul>
        <li>
          <a href="../interface/dashboard.php">
            <i class="bx bxs-grid-alt"></i>
            <span class="nav-item">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>

        <li>
          <a href="../interface/add-user.php">
            <i class="bx bxs-user-plus"></i>
            <span class="nav-item">Users</span>
          </a>
          <span class="tooltip">Users</span>
        </li>

        <li>
          <a href="../docHandling/addNewCase.php">
            <i class="bx bxs-briefcase-alt"></i>
            <span class="nav-item">Add Cases</span>
          </a>
          <span class="tooltip">Add Cases</span>
        </li>

        <li>
          <a href="../add_events/eventAdd.php">
            <i class="bx bxs-file-blank"></i>
            <span class="nav-item">Add Events</span>
          </a>
          <span class="tooltip">Add Events</span>
        </li>

        <li>
          <a href="../add_filing/addRecords.php">
            <i class="bx bxs-file-blank"></i>
            <span class="nav-item">Add Documentation</span>
          </a>
          <span class="tooltip">Add Documentation</span>
        </li>

        <li>
          <a href="../add_filing/showFiles.php">
            <i class="bx bxs-file"></i>
            <span class="nav-item">View Documentation</span>
          </a>
          <span class="tooltip">Review Documentation</span>
        </li>

        <li>
          <a href="#">
            <i class="bx bxs-log-out"></i>
            <span class="nav-item">Logout</span>
          </a>
          <span class="tooltip">Logout</span>
        </li>
      </ul>
    </div>