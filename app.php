
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RTS Eagle - The world, is the battlefield.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo $relative; ?>home">RTS Eagle</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li <?php echo $p=='home'?"class='active'":''; ?>><a href="<?php echo $relative; ?>home">Home</a></li>
              <li><a data-toggle='modal' href='#signUpModal'>Sign Up</a></li>
              <li class="divider-vertical"></li>
              <li><a href="https://github.com/lavaeagle/RTS-Eagle" target='_blank'>GitHub</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <!--
    *
    * Modals
    *
    -->
    <div class="modal" id="signUpModal">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Sign up</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="focusedInput">Username</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="text" value="">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="focusedInput">Email</label>
              <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="email" value="">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="focusedInput">Password</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="password" value="">
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Sign Up</a>
      </div>
    </div>

    <div class="modal" id="signInModal">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Sign in</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="focusedInput">Email</label>
              <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="email" value="">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="focusedInput">Password</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="password" value="">
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Sign In</a>
      </div>
    </div>

    <div class="container">

      <?php require_once("lib/{$p}.php"); ?>

      <hr>

      <footer>
        <p>&copy; RTS Eagle 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/scripts.js"></script>

  </body>
</html>
