<head>
    <?php
    Components::addTitle();
    $filesJs = ['bootstrap.min'];
    $fileCss = ['bootstrap.min', 'bootstrap-theme.min'];
    incFiles::requireFilesJsCss('bootstrap/js', $filesJs, 'js');
    incFiles::requireFilesJsCss('bootstrap/css', $fileCss, 'css');
    ?>
</head>

<body style="background: #e0e0e0">
<div class="container" style="width: 500px; margin-top: 100px">
    <h2>Documents Login</h2>

    <div class="well" style="color: #2aabd2">
        <form role="form" style="text-align: left" action="" method="post">
            <div class="form-group">
                <label>Login:</label>
                <input type="text" class="form-control" placeholder="Enter login" name="login" id="login" rel="popover">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password:</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password"
                       id="password" name="password">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" style="width: 150px" name="log"
                    value="log in"><i class="glyphicon glyphicon-ok-sign">&nbspSign in</i></button>
        </form>
    </div>
</body>
