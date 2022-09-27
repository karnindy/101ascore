<?php
$tab=$_POST['tab'];
$from_page=$_POST['from_page'];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand">101G Lego</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <li class="nav-item <?php if($tab==1){ ?>active<?php } ?>">
        <a class="nav-link" onclick="se_nav_bar(1,'home')">หน้าหลัก <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($tab==2){ ?>active<?php } ?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          สมัครสินเชื่อ
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item <?php if($from_page=='house'){ ?>active<?php } ?>" onclick="se_nav_bar(2,'house')">สินเชื่อบ้าน</a>
          <a class="dropdown-item <?php if($from_page=='person'){ ?>active<?php } ?>" onclick="se_nav_bar(2,'person')">สินเชื่อส่วนบุคคล</a>
        </div>
      </li>

    </ul>
  </div>

</nav>