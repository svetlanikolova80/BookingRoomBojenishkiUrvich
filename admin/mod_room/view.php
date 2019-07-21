<?php
    $_SESSION['id'] = $_GET['id'];
    $mydb->setQuery("select *, typeName from room rm, roomtype rt where rm.typeID = rt.typeID and roomNo=" . $_SESSION['id']);
    $cur = $mydb->loadSingleResult();
?>
<div class="panel panel-primary">
    <div class="panel-body">
        <table class="table table-hover" border="0">
            <caption>
                <h3 align="left">Детайли за стая</h3>
            </caption>
            <tr>
                <td width="80"><img src="<?php echo $cur->roomImage; ?>" width="300" height="300" title="<?php ?>"/></td>
                <td align="left" align="left">
                    <p><strong>Тип стая</strong>
                        <?php
                            echo ': ' . $cur->typename;
						?><br/>
                        <strong>Описание </strong>
                        <?php
                            echo ': ' . $cur->Desp;
						?><br/>
                        <strong>Цена </strong>
                        <?php
                            echo ': ' . $cur->price;
						?><br/>
                        <br/><br/>
                        <input type="button" value="&laquo Назад" class="btn btn-primary" onclick="window.location.href='index.php'" >
                    </p>
        </table>
    </div>    
</div>
