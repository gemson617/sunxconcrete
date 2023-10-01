<div style="box-sizing:border-box;font-family:'Roboto',Helvetica,Arial;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
<?php 
$link=$link;
$find = ['{{link}}'];
$replace = compact('link');
echo str_replace($find, $replace, $body);
?>       
</div>
