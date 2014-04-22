<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Open311 Simple CRM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="/assets/fms-endpoint/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/fms-endpoint/css/bootstrap-theme.min.css">
        
        <link rel="stylesheet" href="/assets/fms-endpoint/css/main.css">

        <?php 
        if (isset($css_files)) :
            foreach($css_files as $file): ?>

                <?php if ((strpos($file, '/bootstrap') !== false)) continue; ?>

                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; 
        endif; 
        ?>
        
        <?php
        if (isset($js_files)) :
             foreach($js_files as $file): ?>

                <?php if ((strpos($file, 'bootstrap.min') !== false) || (strpos($file, 'application.js') !== false) ) continue; ?>

                <script src="<?php echo $file; ?>"></script>
            <?php endforeach;
        endif; ?>

      <link rel="stylesheet" type="text/css" href="/assets/fms-endpoint/css/fms-endpoint.css" />
      <link rel="stylesheet" type="text/css" href="/assets/fms-endpoint/css/print.css" media="print" />

      <?php if (config_item('cobrand_name')) { ?>
        <link rel="stylesheet" type="text/css" href="/assets/cobrands/<?php echo config_item('cobrand_name'); ?>/style.css" />
      <?php } ?>


        <script src="/assets/fms-endpoint/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>




    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-bar"></span>
            <span class="glyphicon glyphicon-bar"></span>
            <span class="glyphicon glyphicon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo config_item('organisation_name'); ?></a>
        </div>

       

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                <?php if (isset($auth) && $auth->logged_in()) : ?>
                    <li><a href='<?php echo site_url('admin/')?>'>Home</a></li> 
                    <li><a href='<?php echo site_url('admin/reports')?>'>Reports detail</a></li>
                    <li><a href='<?php echo site_url('admin/request_updates')?>'>Updates</a></li>
                    <li><a href='<?php echo site_url('admin/reports_csv')?>'>Export CSV</a></li> 
                    <li><a href='<?php echo site_url('admin/help')?>' class="fmse-mysoc">Help</a></li>           
        
                    <?php if ($auth->is_admin()) : ?>
        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='<?php echo site_url('admin/categories')?>'>Categories</a></li>
                                <li><a href='<?php echo site_url('admin/category_attributes')?>'>Category Definitions</a></li>                    
                                <li><a href='<?php echo site_url('admin/statuses')?>'>Statuses</a></li>
                                <li><a href='<?php echo site_url('admin/settings')?>'>Server Settings</a></li>
                                <li><a href='<?php echo site_url('admin/api_keys')?>'>API keys</a></li>
                                <li><a href='<?php echo site_url('admin/open311_clients')?>'>Clients</a></li>
                                <li><a href='<?php echo site_url('auth/')?>'>Users</a></li>
                            </ul>
                        </li>

                    <?php endif; ?>

                <?php else: ?>
            
                    <?php if (function_exists($this->uri->uri_string()) && $this->uri->uri_string() != '/auth/login' ) : ?>
                        <li style="float:right;"><a href='<?php echo site_url('auth/login')?>'>Login</a></li>
                    <?php endif; ?>        
        
                <?php endif; ?>

            </ul>

            <div class="pull-right">

                <?php if (isset($auth) && $auth->logged_in()) : ?>

                    <div class="btn-group">
                        <button type="button" class="btn btn-inverse">
                            <i class="glyphicon glyphicon-user glyphicon glyphicon-white"></i>
                            <?php echo $current_user_data->email ?>
                        </button>
                        <button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                         <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo site_url('/auth/change_password')?>"><i class="glyphicon glyphicon-pencil"></i> Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('auth/logout')?>"><i class="glyphicon glyphicon-remove"></i> Logout</a></li>
                        </ul>
     
                    </div>

                <?php else:  ?>

                    <form class="navbar-form navbar-right">                        
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
    
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>                        

                <?php endif; ?>
            
            </div>

        </div><!--/.navbar-collapse -->
      
      </div>
    </div>


    <div class="container">
      <!-- Example row of columns -->
      <div class="row">    


        <?php if (isset($auth) && $auth->logged_in() && config_item('announcement_html')) { ?>
            <div class="fmse-announcement">
                <?php echo config_item('announcement_html'); ?>
            </div>
        <?php } ?>

