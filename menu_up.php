<nav class="navbar-expand-lg navbar navbar-light bg-light">
    <div class="container">
    <div class="navbar-brand">
        <img src="images\logo1.png" alt="" height="55" width="55">
    </div>
    <div class="navbar-brand">
        <h4 class="mb-0 text-primary"><b>Compass</b></h4>
        <span class="text-end mt-0 text-muted"><h6>IT Store</h6></span>
    </div>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a  class="nav-link">
                <?php if(!empty($_SESSION['m_id'])){ ?>
                <?php if($_SESSION['m_level'] == 1){ ?>
                    ยินดีต้อนรับ: admin
                <?php }else{ ?>
                    ยินดีต้อนรับ: <?php echo $_SESSION['m_name'] ?>
                <?php }  } ?>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <img src="images\Facebook.jpg" alt="" width="30" height="30">
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <img src="images\tiktok.png" alt="" width="30" height="30">
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <img src="images\ig.jpg" alt="" width="30" height="30">
            </a>
        </li>
    </ul>
    </div>
</nav>