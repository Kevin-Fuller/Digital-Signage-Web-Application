<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Generator</title>
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
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query('SELECT * from data');

        ?>

        <div class="">
            <table class="">
            <?php 
                while ($row = $result->fetch_assoc()): 
            ?>
                <tr>
                    <?php if ($row['type']=='isItem'){?>
                    <td><b>Item: </b><?php echo $row['item']; ?></td>
                    <td><b>Price: </b><?php echo $row['price']; ?></td>
                    <td><b>Description: </b><?php echo $row['description']; ?></td>
                    <td>
                    <?php }elseif  ($row['type']=='isSubheader'){?>
                    <td> </td>
                    <td> </td>
                    <td><b>Sub Title: </b><?php echo $row['description']; ?></td>
                    <td>

                    <?php }elseif  ($row['type']=='isItalics'){?>
                    <td> </td>
                    <td> </td>
                    <td><b>Italics Subheader: </b><?php echo $row['description']; ?></td>
                    <td>
                    <?php }else{ ?><div></div><?php }?>

                        <?php if ($row['type']=='isItem'){?>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class=''>Edit </a>
                        <?php }elseif  ($row['type']=='isSubheader'){?>
                            <a href="index.php?editSubheader=<?php echo $row['id']; ?>"
                        class=''>Edit </a>
                        <?php }elseif  ($row['type']=='isItalics'){?>
                            <a href="index.php?editItalics=<?php echo $row['id']; ?>"
                        class=''>Edit </a>
                        <?php }else{ ?><div></div><?php }?>


                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class=''>Delete </a>
                        <?php if ($row['type']=='isItem'){?>
                            <?php
                            if ($row['inOutStock'] == 0):
                            ?>
                            <a href="process.php?outstock=<?php echo $row['id']; ?>"
                            class=''>Out of Stock </a>
                            <?php else: ?>
                            <a href="process.php?instock=<?php echo $row['id']; ?>"
                            class=''>In Stock </a>
                            <?php endif; } else {}?>

                    </td>
                </tr> 
            <?php endwhile;?>   
            </table>
        </div>

    <!--Menu Items-->
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
    
</body>
</html>