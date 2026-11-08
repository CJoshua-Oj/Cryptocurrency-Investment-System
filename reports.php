<?php declare(strict_types=1);require_once __DIR__.'/includes/bootstrap.php';require_login();$title='Reports';$tables=['deposits','withdraw_logs','invest','transfers','exchange_moneys','coinmarkets'];require __DIR__.'/includes/header.php';?>
<h1>Reports</h1><div class="grid">
<?php foreach($tables as $t){
    try {
        $count=(int)(dbone("SELECT COUNT(*) n FROM `$t`")['n']??0);$sum=0;
        foreach(['amount','from_amount'] as $c){try{$sum+=(float)(dbone("SELECT COALESCE(SUM(`$c`),0) n FROM `$t`")['n']??0);}catch(Throwable $e){}}
        echo '<div class="card"><div class="muted">'.e(module_title($t)).'</div><div class="stat">'.$count.'</div><p class="muted">Aggregate amount: '.money($sum).'</p></div>';
    } catch(Throwable $e) {}
} ?>
</div><?php require __DIR__.'/includes/footer.php';?>
