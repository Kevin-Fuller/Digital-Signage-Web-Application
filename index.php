<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Board Generator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once 'process.php'; 

    //Message section displayed when a button is successfully clicked and processed in database.
    if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']); ?>

        </div>
    <?php endif ?>

    <!---Connecting to database--->
    <?php 
    include 'conn.php';
    $result = $mysqli->query('SELECT * from data');?>

    <!--- Displaying all elements in database --->
    <h1>Current Menu Board</h1>
    <div class="">
        <table class="menuPageContent">
            <tr class="head">
                <td>Item</td>
                <td>Price</td>
                <td>Description</td>
                <td class="buttons">Action</td>
            </tr>
        
        <?php //Loops through the data set 
        while ($row = $result->fetch_assoc()): ?>
            <tr>

            <?php //If the row contains a menu item
            if ($row['type']=='isItem'){?>
                <td><?php echo $row['item']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="buttons">

            <?php //If the row contains a subheader
            }elseif  ($row['type']=='isSubheader'){?>
                <td><b>Subheader</b></td>
                <td> </td>
                <td><?php echo $row['description']; ?></td>
                <td class="buttons">

            <?php //If the row contains an italic subheader
            }elseif  ($row['type']=='isItalics'){?>
                <td><b>Italic Subheader</b></td>
                <td> </td>
                <td><b></b><?php echo $row['description']; ?></td>
                <td class="buttons">
            
            <?php //Expand if I add new things here
            }else{ ?><div></div><?php }?>


            <!-----------Button Section ----------->
            <!------Edit Buttons ------->
            <?php //If it is an item:
            if ($row['type']=='isItem'){?>

                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
            
            <?php //If it is a subheader
            } elseif ($row['type']=='isSubheader'){?>

                    <a href="index.php?editSubheader=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
            
            <?php //If it is italic subheader
            } elseif ($row['type']=='isItalics'){?>

                    <a href="index.php?editItalics=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
            
            <?php //If I ever add new items add buttons here
            } else{ ?><?php }?>

            <!---Delete Button --->

            <a onclick="return confirm('Are you sure you wish to delete this item?')" href="process.php?delete=<?php echo $row['id']; ?>" class='delete'><span>Delete</span></a>
            
            <!---IN or Out of Stock Button --->
            <?php 
            if ($row['type']=='isItem'){
                if ($row['inOutStock'] == 0): ?>
                    <a href="process.php?outstock=<?php echo $row['id']; ?>" class='outStock'><span>Out of Stock</span></a>
            
                <?php else: ?>
                    <a href="process.php?instock=<?php echo $row['id']; ?>" class='inStock'><span>In Stock</span></a>
                
                <?php endif; } else {}?>
                </td>
            </tr> 
            <?php endwhile;?>   
        </table>
    </div>


    <div class="controlPanel">
        <div class="controlPanelSection">
            
            <!--Menu Items-->
            <?php 
                if ($update == true): ?>
                    <div class="updating">
                        <h3>Add Menu Item</h3>

                        <form action="process.php" method="POST" class="menuItems">
                            <input type="hidden" name="id" value="<?php echo $id?>">

                            <label>Item Name</label>
                            <input type="text" name="item" value="<?php echo $item; ?>" placeholder="Enter item name">

                            <label>Item Price</label>
                            <input type="text" name="price" value="<?php echo $price; ?>"  placeholder="Enter item price">

                            <label>Item Description</label>
                            <input type="text" name="description" value="<?php echo $description; ?>"  placeholder="Enter item description">

                            <button type="submit" name="update">Update</button>
                        </form>
                    </div>

                <?php else: ?>

                    <h3>Add Menu Item</h3>
                    
                    <form action="process.php" method="POST" class="menuItems">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        
                        <label>Item Name</label>
                        <input type="text" name="item" value="<?php echo $item; ?>" placeholder="Enter item name">
                        
                        <label>Item Price</label>
                        <input type="text" name="price" value="<?php echo $price; ?>"  placeholder="Enter item price">
                        
                        <label>Item Description</label>
                        <input type="text" name="description" value="<?php echo $description; ?>"  placeholder="Enter item description">
                        <button type="submit" name="save">SAVE</button>
                    </form>
                
                <?php endif; ?>
        </div>

        <div class="controlPanelSection">
            <!--SubTitles / Subheaders -->
            <?php 
                if ($updateSubheader == true): ?>
                    <div class="updating">
                        <h3>Update Subtitle</h3>

                            <form action="process.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id?>">
                                
                                <label>Sub Title</label>
                                <input type="text" name="description" value="<?php echo $descriptionSubheader; ?>"  placeholder="Enter item description">
                                
                                <button type="submit" name="update">Update</button>
                            </form>
                    </div>

                <?php else: ?>
                    <h3>Add Subtitle</h3>

                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        
                        <label>Sub Title</label>
                        <input type="text" name="description" value="<?php echo $descriptionSubheader; ?>"  placeholder="Enter item description">
                        
                        <button type="submit" name="saveSubheader">SAVE</button>
                    </form>
                <?php endif; ?>
        </div>


        <div class="controlPanelSection">
            <!--Italics -->
            <?php 
                if ($updateItalics == true): ?>
                    <div class="updating">
                        <h3>Update Italic Message</h3>
                        
                        <form action="process.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            
                            <label>Italic Subheader</label>
                            <input type="text" name="description" value="<?php echo $descriptionItalics; ?>"  placeholder="Enter item description">
                            
                            <button type="submit" name="update">Update</button>
                        </form>
                    </div>

                    <?php else: ?>
                        <h3>Add Italic Message</h3>
                        
                        <form action="process.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            
                            <label>Italic Subheader</label>
                            <input type="text" name="description" value="<?php echo $descriptionItalics; ?>"  placeholder="Enter item description">
                            
                            <button type="submit" name="saveItalics">SAVE</button>
                        </form>
                <?php endif; ?>
        </div>

        <div class="controlPanelSection">
            <!--Color Selector -->
            <h3>Update Primary Color</h3>
            
            <form action="color.php" method="POST">
                <input type="color" name="color" value="<?php 
                    $result = $mysqli->query("SELECT color FROM other WHERE id=1") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>" class="colorSelector">

                <button type="submit" name="saveColor">SAVE</button>
            </form>
        </div>

        <div class="controlPanelSection">
            <!--title-->
            <h3>Change Board Title</h3>

            <form action="title.php" method="POST">
                <input type="text" name="title" placeholder="<?php
                    $result = $mysqli->query("SELECT title FROM other WHERE id=1") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>">

                <button type="submit" name="saveTitle">Update Title</button>
            </form>
        </div>

        <div class="controlPanelSection">
            <!--picture-->
            <h3>Change backdrop picture</h3>

            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">

                <button type="submit" name="submit">Update Image</button>
            </form>
        </div>

    </div>

</body>
</html>