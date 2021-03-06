<?php
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}
//echo 'سلام مدیر';

$admin = new dbUser("support", "localhost", "root", "");

$info = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readUser($sql);

$count = $info->readAllUser('users');

$project = new dbProject("support", "localhost", "root", "");

$countProject = $project->readAllProject('projects');

$tickets = new dbTicket("support", "localhost", "root", "");

$countTicket = $tickets->readAllTicket('tickets');

$customers = new dbCustomer("support", "localhost", "root", "");

$countCustomer = $customers->readAllCustomer('customers');

$comments = new dbComments("support", "localhost", "root", "");

$countComment = $comments->readAllComments('comments');

$domains = new dbDomain("support", "localhost", "root", "");

$countDomain = $domains->readAllDomain('website');

//$config = new Config();
//
//print_r($result);

require_once SOFT_ROOT . '/backend/header.php';
?>

                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?= $result['name']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <a href="editProfile.php?id=<?= $result['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
                            </li>
<!--                            <li><a href="profile.php?id=--><?//= $result['id']; ?><!--"><i class="halflings-icon user"></i> نمایه</a></li>-->
                            <li><a href="logout.php"><i class="halflings-icon off"></i> خروج</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">
        <?php require_once 'sidebar.php'; ?>
        <!-- start: Content -->
        <div id="content" class="span10">

            
            <ul class="breadcrumb text-right">
                <li>
                    <i class="icon-home"></i>
                    <a href="dashboard.php">صفحه اصلی</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="dashboard.php">مدیریت</a></li>
            </ul>

                <div class="row-fluid">
                    <?php if ($_SESSION['Admin']) { ?>
                    <a class="quick-button metro yellow span3" href="users.php">
                        <i class="icon-group"></i>
                        <p>کارمندان</p>
                        <span class="badge"><?= count($count); ?></span>
                    </a>
                    <?php } ?>
                    <a class="quick-button metro red span3">
                        <i class="icon-comments-alt"></i>
                        <p>دامنه ها</p>
                        <span class="badge"><?= count($countDomain) ?></span>
                    </a>
                    <a class="quick-button metro green span3" href="<?= BASE_DOMAIN; ?>/backend/projects/projects.php">
                        <i class="icon-barcode"></i>
                        <p>پروژه ها</p>
                        <span class="badge"><?= count($countProject); ?></span>
                    </a>
                    <a class="quick-button metro pink span3" href="<?= BASE_DOMAIN; ?>/backend/comments/comments.php">
                        <i class="icon-envelope"></i>
                        <p>پیامها</p>
                        <span class="badge"><?= count($countComment) ?></span>
                    </a>
                    <div class="clearfix"></div>

                </div><!--/row-->

                <div class="row-fluid">
                    <a class="quick-button metro pink span3">
                        <i class="icon-envelope"></i>
                        <p>تیکت ها</p>
                        <span class="badge"><?= count($countTicket) ?></span>
                    </a>
                    <a class="quick-button metro pink span3" href="<?= BASE_DOMAIN; ?>/backend/customers/customers.php">
                        <i class="icon-envelope"></i>
                        <p>مشتریان</p>
                        <span class="badge"><?= count($countCustomer) ?></span>
                    </a>
                    <div class="clearfix"></div>

                </div><!--/row-->


        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
