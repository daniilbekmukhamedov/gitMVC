<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="/public/styles/styles.css">
        <script src='/public/scripts/jquery.js'></script>
        <script src='/public/scripts/form.js'></script>
    </head>

    <body>
    <div id="header">
            <div id="headerWrap">
                <div id="logo"><a href="/"></a></div>
                <div id="navigWrap">
                    <div class="navigItem <?php if (isset($_SESSION['admin'])) echo 'navigItemAdmin'; ?>" id="navigItemFirst">
                        <a href="/"><span class="navigItemSpan">Main Page</span></a>
                    </div>

                    <div class="navigItem <?php if (isset($_SESSION['admin'])) echo 'navigItemAdmin'; ?>">
                        <a href="/about"><span class="navigItemSpan">About us</span></a>
                    </div>
                    
                    <div class="navigItem <?php if (isset($_SESSION['admin'])) echo 'navigItemAdmin'; ?>">
                        <a href="/contact"><span class="navigItemSpan">Contact us</span></a>
                    </div>

                    <?php
                        if (isset($_SESSION['admin']))
                        {
                            echo <<<html
<div class="navigItem  navigItemAdmin" id="admin-nav">
                        <a href=""><span class="navigItemSpan">Admin</span></a>
                            <div id="admin-list">
                                <div class="admin-list-item">
                                    <a href="/admin/add"><span class="navigItemSpan">Add news</span></a>
                                </div>
    
                                <div class="admin-list-item">
                                    <a href="/admin/logout"><span class="navigItemSpan">Log out</span></a>
                                </div>
                            </div>
                    </div>
    
html;
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="wrapper">
            <div id="sidebar">
                <ul type="none">
                    <li class="sidebar-li"><a href="/">Main Page</a></li>
                    <li class="sidebar-li"><a href="/about">About us</a></li>
                    <li class="sidebar-li"><a href="/contact">Contact us</a></li>
                    <?php 
                        if (!isset($_SESSION['admin'])) echo '<li class="sidebar-li"><a href="/admin/login">Log in</a></li>';
                        if (isset($_SESSION['admin']))
                        {
                            echo <<<html
<li class="sidebar-li"><a href="/admin/add">Add news</a></li>
                    <li class="sidebar-li"><a href="/admin/logout">Log out</a></li>
html;
                        }
                    ?>
                
                </ul>
            </div>

            <div id="wrapper-center">
                <?= $content; ?>
            </div>

            <div id="right-bar"></div>
        </div>
    </body>
</html>