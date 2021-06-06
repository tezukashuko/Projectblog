<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<?php //var_dump($_SESSION);
$current_script = basename($_SERVER['SCRIPT_NAME'], ".php");

function likecount($post_id, $conn)
{
    $sql = "SELECT * from liked_post WHERE id_post = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $count = $stmt->get_result()->num_rows;
    return $count;
}

function gettimepass($create)
{
    return time_elapsed_string('@' . (string)(strtotime($create) - (60 * 60 * 7)));
}
//copy in internet
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Simple Blog - TMNP</title>

    <link href="//fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style-starter.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <!-- header -->
    <header class="w3l-header" id="navbar" style="transition: 0.4s ease-out;">
        <div class="container">
            <!--/nav-->
            <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-sm-3 px-0">
                <a class="navbar-brand" href="index.php">
                    <span class="fa fa-newspaper-o"></span>Simple Blog </a>
                <!-- if logo is image enable this   
						<a class="navbar-brand" href="#index.html">
							<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
						</a> -->


                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <nav class="mx-auto" style="width: 80%;">
                        <div class="search-bar">
                            <form class="search">
                                <input type="search" class="search__input" name="search" placeholder="Discover news, articles and more" onload="equalWidth()" required>
                                <span class="fa fa-search search__icon"></span>
                            </form>
                        </div>
                    </nav>
                    <ul class="navbar-nav">
                        <li class="nav-item  <?php if ($current_script == 'index') {
                                                    echo 'active';
                                                } ?>">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item  <?php if ($current_script == 'createpost') {
                                                    echo 'active';
                                                } ?>">
                            <a class="nav-link" style="white-space: nowrap;" href="createpost.php">Create Post</a>
                        </li>
                        <?php if ($_SESSION['loggedin'] == false) : ?>
                            <li class="nav-item  <?php if ($current_script == 'login') {
                                                        echo 'active';
                                                    } ?>" data-toggle="modal" data-target="#modelId"><a href="./login.php" class="nav-link">Login</a> </li>
                        <?php else : ?>
                            <li class="nav-item dropdown <?php if ($current_script == 'profile'||$current_script == 'author') {
                                                                echo 'active';
                                                            } ?>">
                                <a class="nav-link dropdown-toggle text-center dropdownhover" href="./profile.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src=" <?php echo $_SESSION['img'] ?> " alt="avatar" style="height: 30px; width: 30px; border-radius: 50%; ">
                                    <?php echo htmlspecialchars($_SESSION['user_name']) ?> <span class="fa fa-angle-down"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item @@b__active" href="<?php echo   "./author.php?user_id=" . $_SESSION['user_id'] ?>"   ><i class="fas fa-user    "></i>
                                        Profile </a>
                                    <a class="dropdown-item @@fa__active" href="./logout.php"></i> <i class="fas fa-sign-out-alt" style="padding-right: 5px;"></i>Logout</a>
                                </div>
                            </li>
                        <?php endif ?>

                        <!-- <li class="nav-item">
                            <a href="" class="nav-link"><img src="assets/images/a1.jpg" alt="avatar"
                                    style="height: 30px; width: 30px; border-radius: 50%; "> Lorem</a>
                        </li> -->
                    </ul>
                </div>
                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
                <!-- //toggle switch for light and dark theme -->
        </div>
        </nav>
        <!--//nav-->

    </header>
    <!-- Button trigger modal -->

    <!-- Modal -->

    <!-- //header -->