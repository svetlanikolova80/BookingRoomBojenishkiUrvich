<?php
    $_SESSION['id']=$_GET['id'];
    $rm = new Roomtype();
    $result = $rm->single_roomtype($_SESSION['id']);
?>
<div class="panel panel-primary">
    <div class="panel-body">
        <table class="table table-hover">
            <caption>
                <h3 align="left">Тип стая</h3>
            </caption>
            <td width="30"><strong>Име на тип</strong></td>
            <td><?php echo ': '.$result->typename; ?></td>
            </tr>
            <tr>
                <td width="30"><strong>Описание </strong></td>
                <td><?php echo ': '.$result->Desp; ?></td>
            </tr>
            <tr>
                <td> <input type="button" value="&laquo Назад" class="btn btn-primary" onclick="window.location.href='index.php'" ></td>
            </tr>
        </table>
    </div>
</div>