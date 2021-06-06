<?php
include "./func/config.php";

if (isset($_GET['likec'])) {
    $sql = "SELECT * from liked_post WHERE id_post = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['post_id']);
    $stmt->execute();
    $count = $stmt->get_result()->num_rows;
    echo $count;
} elseif (isset($_GET['like']) && isset($_SESSION['loggedin']) && isset($_GET["post_id"])) {
    $sql = "SELECT * from liked_post WHERE id_user = ? and id_post = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_SESSION['user_id'], $_GET['post_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    //0 = not like before
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO liked_post(id_post, id_user) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_GET['post_id'], $_SESSION['user_id']);
        $stmt->execute();
    } else {
        //already like 
        $sql = "DELETE FROM liked_post WHERE id_user = ? and id_post = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['user_id'], $_GET['post_id']);
        $stmt->execute();
    }
    $sql = "SELECT * from liked_post WHERE id_post = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['post_id']);
    $stmt->execute();
    $count = $stmt->get_result()->num_rows;
    echo $count;
} elseif (isset($_GET['dlt']) && isset($_SESSION['loggedin']) && isset($_GET["post_id"])) {

    $path = explode('/', $_GET['path']);
    $filename = end($path);
    if (strcmp($filename, "post_default.png") != 0) {
        $filepath = "./assets/post_img/" . $filename;
        unlink($filepath);
    }

    $sql = "  DELETE FROM post WHERE id = ?   ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_GET['post_id']);
    $stmt->execute();

    $sql = "DELETE FROM liked_post WHERE id_post = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_GET['post_id']);
    $stmt->execute();

    $sql = "DELETE FROM comment_post WHERE post_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_GET['post_id']);
    $stmt->execute();
} elseif (isset($_GET['getposts'])) {

    $addition_query = '';
    if (isset($_GET['orderby'])) {
        $addition_query .= " ORDER BY " . $_GET['orderby'];
    }
    if (isset($_GET['limit'])) {
        $addition_query .= " Limit " . $_GET['limit'];
    }
    if (isset($_GET['offset'])) {
        $addition_query .= " offset " . $_GET['offset'];
    }

    $sql = "SELECT post.id, post.title, post.body, post.img as post_img,post.date_create, user.name, user.img as author_img, user.id as author_id from user,post WHERE post.author = user.id " . $addition_query;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo 0;
        return;
    } else {
        $json = [];
        while ($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        echo json_encode($json);
    }
} elseif (isset($_GET['getpostsbyauthor'])) {

    $addition_query = '';
    if (isset($_GET['orderby'])) {
        $addition_query .= " ORDER BY " . $_GET['orderby'];
    }
    if (isset($_GET['limit'])) {
        $addition_query .= " Limit " . $_GET['limit'];
    }
    if (isset($_GET['offset'])) {
        $addition_query .= " offset " . $_GET['offset'];
    }

    $sql = "SELECT post.id, post.title, post.body, post.img as post_img,post.date_create, user.name, user.img as author_img, user.id as author_id from user,post WHERE user.id= ? and post.author = user.id " . $addition_query;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['user_id']);

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo 0;
        return;
    } else {
        $json = [];
        while ($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        echo json_encode($json);
    }
} elseif (isset($_POST["addcomment"])) {
    $sql = "INSERT INTO comment_post(post_id,user_com,body) VALUES (?,?,?)";
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $_POST['post_id'], $_SESSION['user_id'], $content);
    $stmt->execute();

    $sql = "select cm.com_id, cm.body, cm.date_com from comment_post cm where cm.user_com = ? ORDER BY cm.date_com desc limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $json = [];
    $row['themself'] = 1;
    $row['name'] = $_SESSION['user_name'];

    array_push($json, $row);
    echo json_encode($json);
} elseif (isset($_GET['getcmt'])) {

    $sql = "select cm.com_id, u.name, cm.user_com, cm.body, cm.date_com from comment_post cm, user u where cm.post_id = ? and cm.user_com = u.id ORDER BY cm.date_com";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['post_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->field_count === 0) {
        echo 0;
        return;
    } else {
        $json = [];
        while ($row = $result->fetch_assoc()) {
            if ($_SESSION['loggedin'] == true) {
                if ($row['user_com'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 2) {
                    //user = user => can delete || admin can delete all comm
                    $row['themself'] = 1;
                } else {
                    $row['themself'] = 0;
                }
            } else { //no login, no delete btn
                $row['themself'] = -1;
            }
            array_push($json, $row);
        }
        echo json_encode($json);
    }
} elseif (isset($_GET['dltcmt'])) {
    $sql = "DELETE FROM comment_post where com_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['com_id']);
    $stmt->execute();
}
