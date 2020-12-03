<?php
// connection string
// $server = 'www.ccodblendedlearning.com';
// $server_user = 'ccodgradschooluser';
// $server_password = 'ccodgradschooluser@123';
// $database = 'ccodble6_ccodgradschool';

$server = 'localhost';
$server_user = 'root';
$server_password = '';
$database = 'correlation';

$conn = mysqli_connect($server, $server_user, $server_password, $database) or die('Error connecting Database');

function validate($data)
{
    if (empty($data)) {
        return 'empty';
    } else {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        return $data;
    } //end if
}

function select_records($table)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $table") or die('Something went wrong');
    return $query;
}

function select_records_in_order($table, $order)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $table ORDER BY $order") or die('Something went wrong');
    return $query;
}

function select_single_column($column,$table){
	global $conn;
	$query = mysqli_query($conn,"SELECT $column FROM $table") or die('Something went wrong');
	return $query;
}

function select_single_column_on_condition($column,$table,$condition){
	global $conn;
	$query = mysqli_query($conn,"SELECT $column FROM $table WHERE $condition") or die('Something went wrong');
	return $query;
}

function select_single_column_in_order($column,$table,$order){
	global $conn;
	$query = mysqli_query($conn,"SELECT $column FROM $table ORDER BY $order") or die('Something went wrong');
	return $query;
}

function select_records_on_condition($table, $condition)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $table WHERE $condition") or die(mysqli_error($conn));
    return $query;
}

function select_records_on_random_condition($table, $condition, $questions)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $table WHERE $condition ORDER BY RAND() LIMIT $questions") or die(mysqli_error($conn));
    return $query;
}

function select_records_on_condition_in_order($table, $condition, $order)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $table WHERE $condition ORDER BY $order") or die(mysqli_error($conn));
    return $query;
}

function count_rows($table)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT COUNT(*) AS count FROM $table") or die('Something went wrong');
    $query = mysqli_fetch_assoc($query);
    $count = $query['count'];
    return $count;
}

function count_rows_on_condition($table, $condition)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT COUNT(*) AS count FROM $table WHERE $condition") or die('Something went wrong');
    $query = mysqli_fetch_assoc($query);
    $count = $query['count'];
    return $count;
}

function delete_records($table)
{
    global $conn;
    $query = mysqli_query($conn, "TRUNCATE $table") or die('Something went wrong');
    if (mysqli_affected_rows($query) > 0) {
        return 'success';
    } else {
        return 'failed';
    }
}

function delete_record_on_condition($table, $condition)
{
    global $conn;
    $query = mysqli_query($conn, "DELETE FROM $table WHERE $condition") or die('Something went wrong');
    if ($query) {
        return 'success';
    } else {
        return 'failed';
    }
}

function insert_data($table, $fields, $values)
{
    global $conn;
    $str = implode(",", $fields);
    $val = implode(",", $values);
    $query = "insert into $table($str) values($val)";
    $exec = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if ($exec) {
        return 'success';
    } else {
        return 'failed';
    }
}

function update_records($table, $values)
{
    global $conn;
    $query = mysqli_query($conn, "UPDATE $table SET $values") or die('Something went wrong');
    if ($query) {
        return 'success';
    } else {
        return 'failed';
    }
}

function update_record_on_condition($table, $values, $condition)
{
    global $conn;
    $query = mysqli_query($conn, "UPDATE $table SET $values WHERE $condition") or die("Something went wrong");
    if ($query) {
        return 'success';
    } else {
        return 'failed';
    }
}

function record_login_out($userid,$remarks){
    global $conn;

    $ip = NULL; $deep_detect = TRUE;

        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }

        $url="http://www.geoplugin.net/json.gp?ip=".$ip;
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        
        $json = json_decode($result);

        $country =  $json->geoplugin_countryName ;
        $city = $json->geoplugin_city;
        $area = $json->geoplugin_areaCode;
        $code = $json->geoplugin_countryCode;

        $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        $browser        =   "Unknown Browser";
        $browser_array  =   array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser    =   $value;
            }
        }
        // $user->login_time = Carbon::now();
        // $user->save();
        // $ul['user_id'] = $userid;
        // $ul['user_ip'] = $ip;
        $location = $city.(" - $area - ").$country .(" - $code ");
        $details = $browser.' on '.$os_platform;

        mysqli_query($conn,"INSERT INTO system_logs(userid,ipaddress,location,details,remarks) values('$userid','$ip','$location','$details','$remarks')");
}