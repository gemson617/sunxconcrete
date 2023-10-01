<div style="box-sizing:border-box;font-family:'Roboto',Helvetica,Arial,sans-serif;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
    <?php
    $name = $name;
    $risk_register_name = $risk_register_name;
    $logo_path = "https://krisgrc.com/assets/images/GRC.png";
    $url=site_url();
    $find = ['{{logo_path}}','{{name}}', '{{risk_register_name}}'];
    $replace = compact('logo_path', 'name', 'risk_register_name');
    echo str_replace($find, $replace, $body);
    ?>
</div>