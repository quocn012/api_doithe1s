<?php
/**
 * API ĐƯỢC VIẾT BỞI CHÂU CHÍ QUỐC
 * ZALO : 01684853992 CÓ GÌ LH
 */
$username = ""; // tài khoản doithe1s.vn
$password = ""; // mật khẩu doithe1s.vn
/**
 * INFO THÔNG TIN CHUYỄN TIỀN
 */
$sotien = ""; // số tiền chuyễn
$nguoinhan = ""; // người nhận
$lydo = ""; // lý do chuyễn
// đoạn nầy login lấy cookie cái
$curl = curl_init();
curl_setopt_array($curl,[
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => 'https://doithe1s.vn/assets/ajaxs/Auth.php',
    CURLOPT_COOKIEJAR => 'cookie.txt',
    CURLOPT_COOKIEFILE => 'cookie.txt',
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => "type=Login&username=$username&password=$password",
]);
// lưu lại file
$ex = curl_exec($curl);
$file = fopen('info.txt','a');
fwrite($file,"$ex \n");
fclose($file);
curl_close($curl);
// lấy token xong bắt đầu chuyễn tiền
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => 'https://doithe1s.vn/assets/ajaxs/Transfers.php',
    CURLOPT_COOKIEJAR => 'cookie.txt',
    CURLOPT_COOKIEFILE => 'cookie.txt',
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => "type=ChuyenTien&sotien=$sotien&lydo=$lydo&nguoinhan=$nguoinhan",
]);
// lưu lại file
$ex = curl_exec($curl);
$file = fopen('info.txt', 'a');
fwrite($file, "$ex \n");
fclose($file);
curl_close($curl);
var_dump(strip_tags($ex));
?>
