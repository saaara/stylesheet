<table id="datatable-fixed-header" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>المُشتري</th>
        <th>المنتج</th>
        <th>التاريخ</th>
        <th>رقم التتبع</th>
        <th>طريقة الشحن</th>
        <th>طريقة  الدفع</th> 
        <th>حالة  الدفع</th>
        <th>الكمية</th>
        <th>سعر الشحن</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $uid = USER_ID;
    $q = "SELECT * FROM `purchases` WHERE `uid` = '$uid' ";
    $sdm = $engine->connect()->query($q);
    while ($show = $sdm->fetch_array())
    {
        $pid   = $show['pid'];
        $uid   = $show['uid'];
        $qp    = $engine->connect()->query("SELECT * FROM `products` WHERE `pid` = '$pid'");
        $showp = $qp->fetch_array();
        $qu    = $engine->connect()->query("SELECT * FROM `users` WHERE `id` = '$uid'");
        $showu = $qu->fetch_array();
    ?>
    <tr id="users<?=$show['id']?>">
        <th>
            <a href="users#users<?=$showu['id']?>"><?=$showu['name']?>        
        </th>
        <th>
            <a href="../<?=$showp['pid']?>"><?=$showp['name']?></a>
        </th>
        <th><?=counttime($show['date'])?></th>
        <th><?=$show['track']?></th>
        <th><?=$show['shipping']?></th>
        <th><?=$show['payment']?></th>
        <th><?=$show['paystatus']?></th>
        <th><?=$show['q']?></th>
        <th><?=$show['sh_cost']?></th>
    </tr>
    <?}?>
    </tbody>
</table>