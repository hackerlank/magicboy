<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>仙侠世界-主持人/管理员登录</title>
</head>
<body>
<form method="post">
	用户名：<input name="login[name]" type="text" /><br /><br />
	&nbsp;&nbsp;密码：<input name="login[passwd]" type="password" /><br /><br />
	&nbsp;&nbsp;角色：<select name="login[role]">
			  <option value ="1">主持人</option>
			  <option value ="2">管理员</option>
		 </select>
		 <br /><br />
	<input type="submit" value="登录" />&nbsp;&nbsp;<span style="width:100px;font-size:12px;color:red"><?php if (isset($error)) echo $error?></span>
</form>
</body>