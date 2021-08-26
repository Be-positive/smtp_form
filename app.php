<?php
function get_client_ip() {
$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';
return $ipaddress;
} 
$ip = get_client_ip();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM FORM</title>    
</head>
<body>
    <center>
        <h2>CRM Форма</h2>
        <h4 class="sent_feedback"></h4>
        <form id="crm_form" action="#">
            <div>
                <label for="name">Имя</label>
                <input id="name" type="text" placeholder="ваше имя">
            </div><br>
            <div>
                <label for="telephone">Телефон</label>
                <input id="telephone" type="tel" placeholder="номер телефона">
            </div><br>
            <div>
                <label for="email">Почта</label>
                <input id="email" type="email" placeholder="почта">
            </div><br>
            <div>
                <label for="city">Город</label>
                <input id="city" type="text" placeholder="город">
            </div><br>            
            <div>
                <label for="services">Услуги</label>
                <select name="services" id="services">
                    <option value="">--выберите услугу--</option>
                    <option value="диагностика">диагностика</option>
                    <option value="ремонт">ремонт</option>                
                </select>
            </div><br>
            <div>
                <label for="body">Комментарии</label><br>
                <textarea name="body" id="body" cols="30" rows="10" placeholder="Я хочу..."></textarea>
            </div><br>
            <div>
                <input type="hidden" id="ip" name="ip" value= <?php echo $ip ?>>
            </div><br>
            <button type="button" onclick="sendEmail()" value="send info">Отправить</button>
        </form>
    </center>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
    function sendEmail(){
        let name = $("#name");
        let telephone = $("#telephone");
        let email = $("#email");
        let city = $("#city");
        let services = $("#services");
        let body = $("#body");
        let ip = $("#ip");        

        if(isNotEmpty(name) && isNotEmpty(telephone) && isNotEmpty(email) &&  isNotEmpty(city) && isNotEmpty(services) && isNotEmpty(body) && isNotEmpty(ip)){
            $.ajax({
                url: 'index.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name.val(),
                    telephone: telephone.val(),
                    email: email.val(),
                    city: city.val(),
                    services: services.val(),
                    body: body.val(),
                    ip: ip.val(),                  
                }, success: function(response){
                    $('#crm_form')[0].reset();
                    $('.sent_feedback').text("Информация успешно отправлено, в ближайшее время с вами свяжуться.");
                }
            });
        }
    }
    function isNotEmpty(caller){
        if(caller.val() == ""){
            caller.css('border', '0.1em solid red');
            return false;
        } else {
            caller.css('border','');
            return true;
        }
    }
    </script>  
        
</body>
</html>

