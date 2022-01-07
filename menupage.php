<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="menupage.css">
</head>
<body>

<?php 
        include 'conn.php';
        $result = $mysqli->query('SELECT * from data');

        ?>

        <div class="pageTitle">BURGERS & Fries and so much more</div>
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
            <?php endwhile;?>   
            
        </div>
        <style> 
        .subtitle,
        .pageTitle {
            color: <?php
                    $result = $mysqli->query("SELECT color FROM other WHERE id=1") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>;!
        }
        </style>
    
</body>
</html>