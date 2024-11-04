<?php
if( !defined("APP") )
{
    exit("ERROR");
}
?>
<?php
if(USER_TYPE!=="ROOT" && USER_TYPE!=="ADMIN")
{
    exit("<meta http-equiv='refresh' content='0; url=".$_SERVER["SCRIPT_NAME"]."'>");
}
else
{
    ?>
    <div class="form">
        <?php
        define("SECTION_LINK", $_SERVER["SCRIPT_NAME"]."?users");

        $uid = (string)filter_input(INPUT_GET, "uid", FILTER_VALIDATE_INT);
        if($uid!=="")
        {
            define("FORM_LINK", SECTION_LINK."&uid=".$uid);

            $user = findUserById($uid);
            if($user!==FALSE)
            {
                if(isEditableUserType($user["user_type"]))
                {
                    if( isset($_POST["update"]) )
                    {
                        $email = (string)filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

                        if($email!=="")
                        {
                            $duplicateSearch = findUserByEmail($email);
                            if($duplicateSearch===false || $duplicateSearch["user_id"]===$user["user_id"])
                            {
                                $result = $db->request("UPDATE users SET email=? WHERE user_id=?", array($email, $uid));
                                if($result!==-1)
                                {
                                    $password_1 = (string)filter_input(INPUT_POST, "password_1");
                                    $password_2 = (string)filter_input(INPUT_POST, "password_2");

                                    if($password_1!=="" && $password_2!=="")
                                    {
                                        if($password_1===$password_2)
                                        {
                                            $hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);

                                            $queryResult = $db->request("UPDATE users SET password=? WHERE user_id=?", array($hashedPassword, $uid));
                                            if($queryResult!==-1)
                                            {

                                            }
                                            else
                                            {
                                                $_SESSION["error"] = "Password internal error";
                                            }
                                        }
                                        else
                                        {
                                            $_SESSION["error"] = "Password are not equal";
                                        }
                                    }

                                    if (isset($_POST["active"])) {
                                        $db->request("UPDATE users SET active=? WHERE user_id=?", array($_POST["active"], $uid));
                                    }

                                    $newUserType = null;

                                    if (empty($_POST["roles"])) {
                                        if(USER_TYPE==="ROOT")
                                        {
                                            $newUserType = "ADMIN";
                                        }
                                        elseif(USER_TYPE==="ADMIN")
                                        {
                                            $newUserType = "AUTHOR";
                                        }
                                        else
                                        {
                                            exit("Internal error");
                                        }
                                        $db->request("UPDATE users SET user_type=?, role_id=null WHERE user_id=?", array($newUserType, $uid));

                                    } else {
                                        $db->request("UPDATE users SET user_type=null, role_id=? WHERE user_id=?", array($_POST["roles"], $uid));
                                    }

                                    $_SESSION["success"] = "Saved";

                                    exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
                                }
                                else
                                {
                                    $_SESSION["error"] = "Internal error";

                                    exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
                                }
                            }
                            else
                            {
                                $_SESSION["error"] = "Email exists";

                                exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
                            }
                        }
                        else
                        {
                            $_SESSION["error"] = "Invalid input";

                            exit("<meta http-equiv='refresh' content='0; url=".FORM_LINK."'>");
                        }
                    }

                    ?>
                    <section id="contact" class="tm-section">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="<?php echo FORM_LINK ?>" method="post" class="contact-form  form-min-pading white-background-color  position-relative">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user["email"]) ?>" placeholder="Email"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password_1" name="password_1" class="form-control" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password_2" name="password_2" class="form-control" placeholder="Repeat New password" />
                                    </div>
                                    <?php if ($user['role_id'] != null) { ?>
                                        <div class="form-group">
                                            <select name="active" id="active"  class="form-control">
                                                <option value="0" <?= $user["active"] != 1 ? 'selected' : '' ?> >No</option>
                                                <option value="1" <?= $user["active"] == 1 ? 'selected' : '' ?> >Yes</option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    $roles = getRoles();
                                    if( count($roles) > 0 )
                                    {
                                        ?>
                                        <div class="form-group">
                                            <select name="roles" id="roles"  class="form-control">
                                                <option value="" >Null</option>

                                                <?php
                                                $userRoles = getUserRoles($uid);

                                                foreach($roles as $role)
                                                {
                                                    $selected = "";
                                                    if( in_array($role["role_id"], $userRoles) )
                                                    {
                                                        $selected = "selected";
                                                    }
                                                    ?>
                                                    <option <?php echo $selected ?> value="<?php echo $role["role_id"] ?>"><?php echo $role["role_name"] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="save-delete-funktional">
                                        <button type="submit" name="update" class="tm-button btn blue">Update <img src="img/x-square2.png" alt=""></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    <?php
                }
                else
                {
                    $_SESSION["error"] = "Access denied";

                    exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                }
            }
            else
            {
                $_SESSION["error"] = "Invalid user";

                exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
            }
        }
        else
        {
            if( isset($_POST["add"]) )
            {
                $email = (string)filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password_1 = (string)filter_input(INPUT_POST, "password_1");
                $password_2 = (string)filter_input(INPUT_POST, "password_2");

                if($email!=="" && $password_1!=="" && $password_2!=="")
                {
                    if($password_1===$password_2)
                    {
                        $duplicateSearch = findUserByEmail($email);
                        if($duplicateSearch===false)
                        {
                            $newUserType = null;

                            if (empty($_POST["roles"])) {
                                if(USER_TYPE==="ROOT")
                                {
                                    $newUserType = "ADMIN";
                                }
                                elseif(USER_TYPE==="ADMIN")
                                {
                                    $newUserType = "AUTHOR";
                                }
                                else
                                {
                                    exit("Internal error");
                                }
                            }

                            $hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);

                            if ($newUserType) {
                                $queryResult = $db->request("INSERT INTO users (email, name, password, user_profile_entity, user_type) VALUES (?, ?, ?, 0, ?)", array($email, $email, $hashedPassword, $newUserType));
                            } else {
                                $queryResult = $db->request("INSERT INTO users (email, name, password, user_profile_entity, user_type) VALUES (?, ?, ?,  0, null)", array($email, $email, $hashedPassword));
                            }

                            if($queryResult===1)
                            {
                                $insertId = $db->insertId();
                                if($insertId)
                                {
                                    if( isset($_POST["roles"]) && is_string($_POST["roles"]) && ctype_digit($_POST["roles"]) && findRoleById($_POST["roles"])!==false)
                                    {
                                        attachRoleToUser($_POST["roles"], $insertId);
                                    }

                                    $_SESSION["success"] = "Created";

                                    exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                                }
                                else
                                {
                                    $_SESSION["error"] = "Error internal";

                                    exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                                }
                            }
                            else
                            {
                                $_SESSION["error"] = "Email exists";

                                exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                            }
                        }
                        else
                        {
                            $_SESSION["error"] = "Email exists";

                            exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                        }
                    }
                    else
                    {
                        $_SESSION["error"] = "Password are not equal";

                        exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                    }
                }
                else
                {
                    $_SESSION["error"] = "Invalid input";

                    exit("<meta http-equiv='refresh' content='0; url=".SECTION_LINK."'>");
                }
            }
            ?>
            <section id="welcome" class="tm-section">
                <header>
                    <h2 class="tm-blue-text tm-welcome-title tm-margin-b-45">Users</h2>
                </header>
                <form action="<?php echo SECTION_LINK ?>" method="post" class="contact-form first-select form-min-pading white-background-color">
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email"  required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_1" name="password_1" class="form-control" placeholder="Password"  required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_2" name="password_2" class="form-control" placeholder="Repeat new password"  required/>
                    </div>
                    <?php
                    $roles = getRoles();
                    if( count($roles) > 0 )
                    {
                        ?>
                        <div class="form-group">
                            <select name="roles" id="roles"  class="form-control">
                                <option value="">Null</option>
                                <?php
                                foreach($roles as $role)
                                {
                                    ?>
                                    <option value="<?php echo $role["role_id"] ?>"><?php echo $role["role_name"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="btn-margin">
                        <button type="submit" name="add" class="tm-button btn green">Add <img src="img/plus-square.svg" alt=""></button>
                    </div>
                </form>
                <?php
                if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" ) {
                    $results = $db->data("SELECT COUNT(*) AS mCnt FROM users WHERE name LIKE ?", array("%". $_GET["keyword"] . "%"));
                } else {
                    $results = $db->data("SELECT COUNT(*) AS mCnt FROM users ", array());
                }

                if( count($results) > 0 )
                {
                    $page = 1;
                    if( isset($_GET["page"]) && is_string($_GET["page"]) && ctype_digit($_GET["page"]) )
                    {
                        $page = abs( (int)$_GET["page"] );

                        if($page < 1)
                        {
                            $page = 1;
                        }
                    }

                    $offset = ($page - 1) * PAGE_SIZE;

                    $pages = ceil($results[0]["mCnt"] / PAGE_SIZE);

                    if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
                    {
                        $users = $db->data("SELECT * FROM users  WHERE name LIKE ? LIMIT ?, ?", array("%". $_GET["keyword"] . "%", $offset, PAGE_SIZE));
                    } else {
                        $users = $db->data("SELECT * FROM users  LIMIT ?, ?", array($offset, PAGE_SIZE));
                    }

                    if( count($users) > 0 )
                    {
                        ?>
                        <div class="top-section-funktional">
                            <div class="search-and-add">
                                <div class="search-wrap">
                                    <form action="<?php echo SECTION_LINK ?>" method="get">
                                        <?php
                                        $keyword = "";

                                        if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" )
                                        {
                                            $keyword = trim($_GET["keyword"]);
                                        }
                                        ?>
                                        <input type="hidden" name="users">
                                        <input type="text" name="keyword" class="keyword" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES) ?>" placeholder="search..">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="contact-form form-pading white-background-color border-rad top-bottom-marg">
                            <table border="1" cellpadding="5" cellspacing="0" class="report">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Last seen</th>
                                    <th>IP</th>
                                    <th>Role</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($users as $key=>$user)
                                {
                                    $role = null;
                                    if (!empty($user["role_id"])) {
                                        $role = $db->data("SELECT * FROM roles WHERE role_id = ?", array($user["role_id"]));
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $user["user_id"] ?></td>
                                        <td><?php echo $user["email"] ?></td>
                                        <td><?php echo $user["user_last_seen"] ?></td>
                                        <td><?php echo $user["user_ip"] ?></td>
                                        <td><?php echo $role[0]['role_name'] ?? '' ?></td>
                                        <td><?php echo $user["user_type"] ?? '' ?></td>
                                        <td>
                                            <?php
                                            if(isEditableUserType($user["user_type"]))
                                            {
                                                ?>
                                                <a href="<?php echo SECTION_LINK."&uid=".$user["user_id"] ?>" class="linkButton  btn blue">EDIT <img src="img/x-square.png" alt=""></a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        if($pages > 1)
                        {
                            $baseLink = SECTION_LINK;
                            ?>
                            <form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="get" name="pagerForm">
                                <input type="hidden" name="users" />
                                <?php
                                    if( isset($_GET["keyword"]) && is_string($_GET["keyword"]) && trim($_GET["keyword"])!=="" ) {
                                        $baseLink .= "&keyword=" . $_GET["keyword"];
                                ?>
                                        <input type="hidden" name="keyword" value="<?= $_GET["keyword"] ?>" />
                                <?php
                                    }
                                ?>
                                <div class="myPagination align-center">
                                    <div>
                                        <?php
                                        if($page > 1)
                                        {
                                            ?>
                                            <a class="btn green" href="<?php echo $baseLink."&page=".($page-1) ?>">⇐</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="inputTd select-element">
                                        <select name="page" onchange="document.pagerForm.submit()"  class="form-control">
                                            <?php
                                            for($i=1; $i<=$pages; $i++)
                                            {
                                                $selected = "";

                                                if($i===$page)
                                                {
                                                    $selected = "selected";
                                                }
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <?php
                                        if($page < $pages)
                                        {
                                            ?>
                                            <a class="btn green" href="<?php echo $baseLink."&page=".($page+1) ?>">⇒</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                }
                ?>
            </section>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
