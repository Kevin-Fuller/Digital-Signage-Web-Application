<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Board</title>
    <link rel="stylesheet" href="style/menupage.css">
</head>
<body>

<?php 
        include 'scripts/conn.php';

        $currentTableName = $_GET['currentTableName'];

        $result = $mysqli->query("SELECT * from data WHERE tableGroup = '$currentTableName'");


        ?>
        <div class="pageTitle">
            <?php
                    $myTitle = $mysqli->query("SELECT title FROM other WHERE tableName = '$currentTableName'") or die($mysqli->error());
                    $row = mysqli_fetch_array($myTitle);
                    echo($row[0]); 
            ?>
                    
        </div>
        <div class="pageContent">
            
            <?php 
                while ($row = $result->fetch_assoc()):
                    if ($row['type']=="isItem"){ 
                        if ($row['inOutStock']=="1"){?>
                            <div class="menuItemCell">
                                <div class="topMenuItemCell">
                                    <p class='leftMenu'><?php echo $row['item']; ?></p>
                                    <p class='rightMenu'><?php echo $row['price']; ?></p>
                                </div>
                                <div class="bottomMenuItemCell">
                                    <p><?php echo $row['description']; ?></p>
                                </div>
                            </div> 
                    <?php } else { ?> 
                        <div class="menuItemCell outStock">
                                <div class="topMenuItemCell">
                                    <p class='leftMenu out'><?php echo $row['item']; ?></p>
                                    <p class='rightMenu out'><?php echo $row['price']; ?></p>
                                </div>
                                <div class="bottomMenuItemCell">
                                    <p>Out of Stock</p>
                                </div>
                            </div>
                    
                    <?php }
                    } elseif ($row['type']=="isSubheader"){ ?>
                        <h2 class="subtitle"><?php echo $row['description']; ?></h2>

                    <?php 
                     } elseif ($row['type']=="isItalics"){ ?>
                        <h2 class="italics"><?php echo $row['description']; ?></h2>
                    <?php
                        
                     } ?>
            <?php endwhile;
            

            $result = $mysqli->query("SELECT imageToggledOnOff FROM other WHERE tableName='$currentTableName'") or die($mysqli->error());
            $row = mysqli_fetch_array($result);

            if($row['imageToggledOnOff'] === "1"){ ?>
    <div id="overlayImage"></div>
    <?php }

    $result = $mysqli->query("SELECT festiveMode FROM other WHERE tableName='$currentTableName'") or die($mysqli->error());
            $row = mysqli_fetch_array($result);

            if($row['festiveMode'] === "1"){ ?>
    <div id="festive"></div>
    <?php }?>
        </div>
        <style> 
        .subtitle,
        .pageTitle {
            color: <?php
                    $result = $mysqli->query("SELECT color FROM other WHERE tableName = '$currentTableName'") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>;!
        }
        body{
            background-image: url("images/<?php echo($currentTableName)?>.jpg");
        }
        #overlayImage {
            background-image: url("images/<?php echo($currentTableName)?>Overlay.jpg");
        }
        </style>
    
</body>
</html>