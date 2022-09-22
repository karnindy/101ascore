<?php
$tab=$_POST["tab"];
?>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item <?php if($tab=='1'){ ?> active activee <?php } ?>">
          <a class="nav-link" onclick="se_tab(1)" style="cursor: pointer;">การค้นหาและแสดงผลใบคำขอสินเชื่อ</a>
        </li>

        <li class="nav-item <?php if($tab=='2'){ ?> active activee <?php } ?>">
          <a class="nav-link" onclick="se_tab(2)" style="cursor: pointer;">ข้อมูลใบคำขอสินเชื่อ</a>
        </li>

        <li class="nav-item <?php if($tab=='3'){ ?> active activee <?php } ?>">
          <a class="nav-link" onclick="se_tab(3)" style="cursor: pointer;">ข้อมูลใบคำขอทุก Sequence</a>
        </li>

        <li class="nav-item <?php if($tab=='4'){ ?> active activee <?php } ?>">
          <a class="nav-link" onclick="se_tab(4)" style="cursor: pointer;">ข้อมูลการคำนวณ</a>
        </li>

        <li class="nav-item <?php if($tab=='5'){ ?> active activee <?php } ?>">
          <a class="nav-link" onclick="se_tab(5)" style="cursor: pointer;">การค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล</a>
        </li>
        
      </ul>
    </div>
  </nav>