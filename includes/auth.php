<?php
declare(strict_types=1);
function require_login(): void { if(!user_id() && !admin_id()) redirect('login.php'); }
function require_user(): void { if(!user_id()) redirect('login.php'); }
function require_admin(): void { if(!admin_id()) redirect('admin/login.php'); }
function current_user(): ?array { static $u; if($u!==null)return $u; return $u=user_id()?dbone('SELECT * FROM users WHERE id=?',[user_id()]):null; }
function current_admin(): ?array { static $a; if($a!==null)return $a; return $a=admin_id()?dbone('SELECT * FROM admins WHERE id=?',[admin_id()]):null; }
