<div style="box-sizing:border-box;font-family:'Roboto',Helvetica,Arial,sans-serif;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
    <?php
    $verification_token = $verification_token;
    $name = $name;
    $client_id = $client_id;
    $logo_path = "https://krisgrc.com/assets/images/GRC.png";
    $url=site_url();
    $find = ['{{logo_path}}', '{{user_name}}', '{{verification_token}}', '{{client_id}}','{{url}}'];
    $replace = compact('logo_path', 'name', 'verification_token', 'client_id','url');
    echo str_replace($find, $replace, $body);
    ?>
</div>