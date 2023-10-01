<div style="box-sizing:border-box;font-family:'Roboto',Helvetica,Arial,sans-serif;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
<?php 
$company_name=$company_name;
$url=site_url();
$find = ['{{otp}}'];
$replace = compact('otp');
echo str_replace($find, $replace, $body);
?>
</div>