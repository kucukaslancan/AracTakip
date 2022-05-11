<?php
 
include 'arvento.class.php';
$log = array(
    'Username' => '',
    'PIN1' => '',
    'PIN2' => '',
    'Language' => '0'
);
$arventoApi = new ArventoAPI($log);

if(@$_GET['type'])
{
    switch ($_GET['type']) {
        case 'carList':
            $cars = json_decode($arventoApi->myCars(),true);
             foreach ($cars as $car) {
                echo '<option value="'.$car['plaka'].'">'.$car['plaka'].'</option>';
             }
            break;

            case 'getCarLocation':
                  $data = $arventoApi->getCarInfo($_GET['plaka']);
                break;
        
        default:
            # code...
            break;
    }
}