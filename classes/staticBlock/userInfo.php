<nav class='navbar navbar-default' role='navigation' style="margin-bottom: 0px">
    <div class='container-fluid'>
        <div class='navbar-header'>
            <p class='navbar-brand' style='color: #222222'><b><i class="glyphicon glyphicon-user">&nbspUser: </i></b>
            </p>
            <a class='navbar-brand' href='<?= ManagerUrl::getUrl() . 'user' ?>'
               style='color: #0088CC'><u><?= $_SESSION['login']; ?></u></a>

            <p class='navbar-brand' style='color: #222222'>(<i><?= $_SESSION['name']; ?> <?= $_SESSION['surname'] ?></i>)
            </p>
        </div>
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            <ul class='nav navbar-nav navbar-right'>
                <form name='logout' class='navbar-form navbar-right' action='' method='post'>
                    <button type='submit' class='btn btn-default' name='back_link' value='login'
                            style='border-color: #0088CC'>Log out
                    </button>
                </form>
                <form name='logout' class='navbar-form navbar-right' action='' method='post'>
                    <button type='submit' class='btn btn-default' name='back_link' value='settings'
                            style='border-color: #0088CC'>Settings
                    </button>
                </form>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_POST['back_link'])) {
    if ($_POST['back_link'] == 'login')
        Auth::logout();
    ManagerUrl::redirect($_POST['back_link']);
}
?>