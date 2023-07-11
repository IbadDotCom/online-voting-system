<?php

    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else {
        $status = '<b style="color:green">Voted</b>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<style>
    #backbtn {
        padding: 8px 10px;
        border: none;
        border-radius: 5px;
        background-color: aqua;
        font-weight: 700;
        float: left;
        cursor: pointer;
    }

    #logoutbtn {
        padding: 8px 10px;
        border: none;
        border-radius: 5px;
        background-color: aqua;
        font-weight: 700;
        float: right;
        cursor: pointer;
    }

    #Profile {
        background-color: white;
        color: black;
        width: 30%;
        padding: 20px;
        float: left;
        border-radius: 15px;
    }

    #Group {
        background-color: white;
        color: black;
        width: 60%;
        padding: 20px;
        float: right;
        border-radius: 15px;
    }
    #votebtn {
        padding: 5px;
        font-size: 15px;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
    }

    #mainpanel {
        padding: 25px 50px;
    }
    #voted{
        padding: 5px;
        font-size: 15px;
        background-color: green;
        color: white;
        border-radius: 5px;        
    }

    #headerSection{
        padding: 20px;
    }

    #groups{
        padding: 12px 5px;
    }
</style>

<body>
    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>

        <hr>
        
        <div id="mainpanel">
            <div id="Profile">
                <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100" ></center><br><br>
                <b>Name: </b> <?php echo $userdata['name']?> <br><br>
                <b>Mobile: </b> <?php echo $userdata['mobile']?> <br><br>
                <b>Address: </b> <?php echo $userdata['address']?> <br><br>
                <b>Status: </b> <?php echo $status ?> <br><br>
            </div>
            
            <div id="Group">
                <?php
                    if($_SESSION['groupsdata']){
                        for($i=0; $i<count($groupsdata); $i++){
                            ?>
                            <div id="groups">
                                <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                                <b>Group Name: </b><?php echo $groupsdata[$i]['name'] ?><br><br>
                                <b>Votes: </b><?php echo $groupsdata[$i]['vote'] ?><br><br>
                                <form action="../api/vote.php" method="POST">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['vote'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                    <?php
                                        if($_SESSION['userdata']['status']==0){
                                            ?>
                                            <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button disabled name="votebtn" value="vote" id="voted">Voted</button>
                                            <?php
                                        }
                                    ?>
                                    
                                </form>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                    else{}
                ?>
            </div>
        </div>

    </div>
</body>
</html>
