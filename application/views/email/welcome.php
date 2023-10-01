<div style="box-sizing:border-box;font-family:'Roboto',Helvetica,Arial,sans-serif;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
<?php 
$company_name=$company_name;
$username=$username;
$password=$password;
$url=site_url();
$find = ['{{company_name}}','{{username}}','{{password}}'];
$replace = compact('company_name','username','password');
echo str_replace($find, $replace, $body);
?>
</div>