<?php
/**
 * @author Nick Kaye <nick@outrightmental.com>
 * ©2013 Outright Mental Inc.
 * All Rights Reserved
 */
include_once(__DIR__ . '/protected/App.php');
/** @var App $app */
$app = new App();

?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="favicon" href="favicon.ico">
    <style>
        body {
            padding-top: 100px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="apple-touch-icon-144x144-precomposed.png"
                                              style="height:40px;width:40px"/> <?php echo App::PROJECT_NAME; ?></a>
    </div>
    <div class="navbar-collapse collapse">
        <!--
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
        </ul>
        -->
        <form class="navbar-form navbar-right">
            <div class="form-group">
                <input size="60" name="access_token" type="text" placeholder="paste access_token here"
                       class="form-control"
                       value="<?php echo $app->access_token; ?>">
            </div>
            <button type="submit" class="btn btn-success">Scrape</button>
        </form>
    </div>
    <!--/.navbar-collapse -->
    <?php include(__DIR__ . '/protected/views/task-header.php'); ?>
</div>

<div class="row-fluid terminal">
    <div class="col-md-12">
        <?php $app->taskScraper->scrape(true, Util::requestVar('page')); ?>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>

<?php
if (count($app->taskScraper->tasks)) {
    /**
     * We have tasks: Display them in HTML using Twitter Bootstrap
     */
    /** @var ProducteevTask $task */
    foreach ($app->taskScraper->tasks as $task)
        if ($task instanceof ProducteevTask)
            include(__DIR__ . '/protected/views/task.php');
        else
            echo '<div class="row task"><div class="col-md-12">BAD DATA:<br/>' . var_export($task, true) . '</div></div>';
    ?>

<?php
} else {
    /**
     * NO tasks: Display Description & Instructions
     */
    ?>

    <div class="row-fluid">
        <div class="col-md-6 description">
            <?php echo App::PROJECT_DESCRIPTION; ?>
            <a class="link" target="_blank" href="<?php echo App::PROJECT_URL; ?>"><?php echo App::PROJECT_URL; ?></a>
        </div>
        <div class="col-md-6 instructions">
            <?php echo App::PROJECT_INSTRUCTIONS; ?>
        </div>
    </div>

<?php } ?>

<div class="clearfix">&nbsp;</div>
<div class="row-fluid">
    <div class="col-md-12">
        <hr>
        <footer>
            <p>&copy; Outright Mental Inc. <?php echo date('Y'); ?></p>
        </footer>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>
