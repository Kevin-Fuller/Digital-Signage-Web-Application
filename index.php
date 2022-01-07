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
    <?php require_once 'process.php'; ?>

    <?php
    
        if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            
        ?>
        </div>
        <?php endif ?>

    <?php 
        include 'conn.php';
        $result = $mysqli->query('SELECT * from data');

        ?>

        <h1>Current Menu Board</h1>
        <div class="">
            <table class="menuPageContent">
                <tr class="head">
                    <td>Item</td>
                    <td>Price</td>
                    <td>Description</td>
                    <td class="buttons">Action</td>
                </tr>
            <?php 
                while ($row = $result->fetch_assoc()): 
            ?>
                <tr>
                    <?php if ($row['type']=='isItem'){?>
                    <td><b></b><?php echo $row['item']; ?></td>
                    <td><b></b><?php echo $row['price']; ?></td>
                    <td><b></b><?php echo $row['description']; ?></td>
                    <td class="buttons">
                    <?php }elseif  ($row['type']=='isSubheader'){?>
                    <td><b>Subheader</b></td>
                    <td> </td>
                    <td><b></b><?php echo $row['description']; ?></td>
                    <td class="buttons">

                    <?php }elseif  ($row['type']=='isItalics'){?>
                    <td><b>Italic Subheader</b></td>
                    <td> </td>
                    <td><b></b><?php echo $row['description']; ?></td>
                    <td class="buttons">
                    <?php }else{ ?><div></div><?php }?>

                        <?php if ($row['type']=='isItem'){?>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
                        <?php }elseif  ($row['type']=='isSubheader'){?>
                            <a href="index.php?editSubheader=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
                        <?php }elseif  ($row['type']=='isItalics'){?>
                            <a href="index.php?editItalics=<?php echo $row['id']; ?>"
                        class='edit'><span>Edit</span></a>
                        <?php }else{ ?><?php }?>


                        <a onclick="return confirm('Are you sure?')" href="process.php?delete=<?php echo $row['id']; ?>"
                        class='delete'><span>Delete</span></a>
                        <?php if ($row['type']=='isItem'){?>
                            <?php
                            if ($row['inOutStock'] == 0):
                            ?>
                            <a href="process.php?outstock=<?php echo $row['id']; ?>"
                            class='outStock'><span>Out of Stock</span></a>
                            <?php else: ?>
                            <a href="process.php?instock=<?php echo $row['id']; ?>"
                            class='inStock'><span>In Stock</span></a>
                            <?php endif; } else {}?>

                    </td>
                </tr> 
            <?php endwhile;?>   
            </table>
        </div>

    <!--Menu Items-->
    <h3>Add Menu Item</h3>
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Item Name</label>
        <input type="text" name="item" value="<?php echo $item; ?>" placeholder="Enter item name">
        <label>Item Price</label>
        <input type="text" name="price" value="<?php echo $price; ?>"  placeholder="Enter item price">
        <label>Item Description</label>
        <input type="text" name="description" value="<?php echo $description; ?>"  placeholder="Enter item description">
        <?php 
        if ($update == true):
        ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="save">SAVE</button>
        <?php endif; ?>

    </form>


    <!--SubTitles / Subheaders -->
    <h3>Add Subtitle</h3>
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Sub Title</label>
        <input type="text" name="description" value="<?php echo $descriptionSubheader; ?>"  placeholder="Enter item description">
        <?php 
        if ($updateSubheader == true):
        ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="saveSubheader">SAVE</button>
        <?php endif; ?>

    </form>

    <!--Italics -->
    <h3>Add Italic Message</h3>
        <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Italic Subheader</label>
        <input type="text" name="description" value="<?php echo $descriptionItalics; ?>"  placeholder="Enter item description">
        <?php 
        if ($updateItalics == true):
        ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="saveItalics">SAVE</button>
        <?php endif; ?>

    </form>

    <!--Color Selector -->
    <h3>Update Primary Color</h3>
    <form action="color.php" method="POST">
        <input type="color" name="color" value="<?php
                    $result = $mysqli->query("SELECT color FROM other WHERE id=1") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>">
        <button type="submit" name="saveColor">SAVE</button>
    </form>

    <!--title-->
    <h3>Change Board Title</h3>
    <form action="title.php" method="POST">
        <input type="title" name="title" placeholder="<?php
                    $result = $mysqli->query("SELECT title FROM other WHERE id=1") or die($mysqli->error());
                    $row = mysqli_fetch_array($result);
                    echo($row[0]); ?>">
        <button type="submit" name="saveTitle">Update Title</button>
    </form>

    




</body>
</html>