<?php
    if(! isset($_SESSION)){
        session_start();
    }
    // isset($pageName) ? null : ($pageName='');
?>
<style>
    nav.navbar .nav-item .nav-link.active {
        border-radius: 5px;
        background-color: #00F;
        color: white;
        font-weight: 800;
    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='base' ? 'active' : ''  ?>" 
                        href="basepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='list' ? 'active' : ''  ?>" 
                        href="list.php">列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='insert' ? 'active' : ''  ?>" 
                        href="insert-form.php">新增</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login-form-api.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">註冊</a>
                        </li>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['admin']['account'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout-admin.php">登出</a>
                        </li>
                    <?php endif; ?>



                </ul>

            </div>
        </div>
    </nav>
</div>