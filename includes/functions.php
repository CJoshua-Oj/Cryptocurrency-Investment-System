<?php
declare(strict_types=1);
function e(mixed $v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: '.$url); exit; }
function url(string $page='', array $params=[]): string { return 'index.php?'.http_build_query(array_merge(['page'=>$page],$params)); }
function flash(string $type,string $message): void { $_SESSION['flash'][]=[$type,$message]; }
function flashes(): string { $o=''; foreach($_SESSION['flash']??[] as [$t,$m]) $o.='<div class="alert '.e($t).'">'.e($m).'</div>'; unset($_SESSION['flash']); return $o; }
function csrf_token(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function csrf_field(): string { return '<input type="hidden" name="csrf" value="'.e(csrf_token()).'">'; }
function verify_csrf(): void { if(!hash_equals($_SESSION['csrf']??'', $_POST['csrf']??'')){ http_response_code(419); exit('Invalid CSRF token'); } }
function money(float|int|string $n): string { return number_format((float)$n,2); }
function trx(): string { return strtoupper(bin2hex(random_bytes(6))); }
function old(string $key,mixed $default=''): mixed { return $_POST[$key] ?? $default; }
function post(string $key,mixed $default=null): mixed { return $_POST[$key] ?? $default; }
function get(string $key,mixed $default=null): mixed { return $_GET[$key] ?? $default; }
function setting(string $key,mixed $default=''): mixed { static $s=null; if($s===null){ try{$s=dbone('SELECT * FROM basic_settings ORDER BY id LIMIT 1')??[];}catch(Throwable $e){$s=[];} } return $s[$key]??$default; }
function log_action(string $action,string $description=''): void { try{dbq('INSERT INTO activity_logs(user_id,admin_id,action,description,ip) VALUES(?,?,?,?,?)',[user_id(),admin_id(),$action,$description,$_SERVER['REMOTE_ADDR']??'']);}catch(Throwable $e){} }
function user_id(): ?int { return isset($_SESSION['user_id'])?(int)$_SESSION['user_id']:null; }
function admin_id(): ?int { return isset($_SESSION['admin_id'])?(int)$_SESSION['admin_id']:null; }
function table_exists(string $table): bool { try{db()->query('SELECT 1 FROM `'.str_replace('`','',$table).'` LIMIT 1');return true;}catch(Throwable $e){return false;} }
function safe_table(string $table): string { if(!preg_match('/^[A-Za-z0-9_]+$/',$table)) throw new RuntimeException('Invalid table'); return $table; }
function columns(string $table): array { $table=safe_table($table); return db()->query("DESCRIBE `$table`")->fetchAll(); }
function module_title(string $table): string { return ucwords(str_replace('_',' ',preg_replace('/s$/','',$table))); }
function value_for(array $row,string $col): string { $v=$row[$col]??''; if(is_string($v)&&strlen($v)>120) $v=substr($v,0,117).'...'; return (string)$v; }
