<?php
/**
 * API ĐƯỢC VIẾT BỞI CHÂU CHÍ QUỐC
 * ZALO : 01684853992 CÓ GÌ LH
 */
header("Content-type: application/json; charset=utf-8");
$username = ""; // tài khoản doithe1s.vn
$password = ""; // mật khẩu doithe1s.vn
function float_money($int)
    {
        return preg_replace('/[^0-9]/','',$int);
    }
// đoạn nầy login lấy cookie cái
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => 'https://doithe1s.vn/assets/ajaxs/Auth.php',
    CURLOPT_COOKIEJAR => 'cookie.txt',
    CURLOPT_COOKIEFILE => 'cookie.txt',
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => "type=Login&username=$username&password=$password",
]);
$ex = curl_exec($curl);
curl_close($curl);
// lấy cookie xong bắt đầu check
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => 'https://doithe1s.vn/Transfers.php',
    CURLOPT_COOKIEJAR => 'cookie.txt',
    CURLOPT_COOKIEFILE => 'cookie.txt',
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_SSL_VERIFYPEER => false,
]);
$curl_data = curl_exec($curl);
curl_close($curl);
$dom = new \DOMDocument();
$dom_html = $dom->loadHTML($curl_data);
$table = $dom->getElementsByTagName('table')[3];
$paragraphs = $table->getElementsByTagName('td');
$magd = $paragraphs->item(1)->nodeValue;
$tr = $table->getElementsByTagName('tr');
        for ($i = 0;$i < $tr->length;$i++){
            $td = $tr->item($i)->getElementsByTagName('td');
            $trandID = trim($td->item(0)->nodeValue);
            $code = trim($td->item(1)->nodeValue);
            $username = trim($td->item(2)->nodeValue);
            $money = float_money(trim($td->item(3)->nodeValue));
            $time = trim($td->item(4)->nodeValue);
            $noidung = $td->item(5)->nodeValue;
            echo json_encode([
                'id' => $trandID,
                'magd' => $code,
                'nguoi_gui' => $username,
                'sotien' => $money,
                'time' => $time,
                'noi_dung' => $noidung
            ],JSON_PRETTY_PRINT);
        }
?>
