<?php
    $_SESSION['id']=$_GET['id'];
    $mydb->setQuery("select * from amenities where amen_id=".$_SESSION['id']);
    $cur = $mydb->loadSingleResult();
    
    ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <table class="table table-hover" border="0">
            <caption>
                <h3 align="left">Детайли за удобство</h3>
            </caption>
            <tr>
                <td width="80"><img src="<?php echo $cur->amen_image; ?>" width="300" height="300" /></td>
                <td align="left" align="left">
                    <p><strong>Име </strong>
                        <?php echo ': '.$cur->amen_name; ?><br/>
                        <strong>Описание </strong>
                        <?php echo ': '.$cur->amen_desp; ?><br/>
                        <input type="button" value="&laquo Назад" class="btn btn-primary" onclick="window.location.href='index.php'" >
                    </p>
                </td>
			</tr>
        </table>
    </div>    
</div>