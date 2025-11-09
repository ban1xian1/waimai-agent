<?php

// 数据库连接信息
$dsn      = 'mysql:host=154.205.6.12;dbname=dev_admin_ksmovi;charset=utf8mb4';
$username = 'root';
$password = '06b71739e5dce8f0';

try {
    // 创建 PDO 实例
    $pdo = new PDO($dsn, $username, $password);

    // 设置错误模式为异常模式
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "数据库错误：" . $e->getMessage();
    die();
}
function fathergetdata()
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://mapi.nobody-pro.com/nobodypro/api/playletWeb/getPlayletList?page=1&rows=20',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,

        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER    => array(
            'accept: application/json, text/plain, */*',
            'accept-encoding: gzip, deflate, br, zstd',
            'accept-language: zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7',
            'access-control-allow-headers: X-Requested-With',
            'authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhY2NvdW50SWQiOiIxNjEzNTMiLCJuYmYiOjE3MzU5NzczNjYsImFkZHJlc3MiOiJ3b3Jkc2Fuc2h1QGdtYWlsLmNvbSIsImV4cCI6MTczNjU4MjE2NiwiaWF0IjoxNzM1OTc3MzY2fQ.ME77oHRwrlBDJFenGKUj8sgGkAxBgJm83-uNTJzckwU',
            'cache-control: no-cache',
            'dnt: 1',
            'language: en',
            'origin: https://www.nobody-pro.com',
            'pragma: no-cache',
            'priority: u=1, i',
            'referer: https://www.nobody-pro.com/',
            'sec-ch-ua: "Google Chrome";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: same-site',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getdata($uuid)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://mapi.nobody-pro.com/nobodypro/api/playlet/getPlayletDetailsVip?uuid=' . $uuid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,

        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER    => array(
            'accept: application/json, text/plain, */*',
            'accept-encoding: gzip, deflate, br, zstd',
            'accept-language: zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7',
            'access-control-allow-headers: X-Requested-With',
            'authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhY2NvdW50SWQiOiIxNjEzNTMiLCJuYmYiOjE3MzU5NzczNjYsImFkZHJlc3MiOiJ3b3Jkc2Fuc2h1QGdtYWlsLmNvbSIsImV4cCI6MTczNjU4MjE2NiwiaWF0IjoxNzM1OTc3MzY2fQ.ME77oHRwrlBDJFenGKUj8sgGkAxBgJm83-uNTJzckwU',
            'cache-control: no-cache',
            'dnt: 1',
            'language: en',
            'origin: https://www.nobody-pro.com',
            'pragma: no-cache',
            'priority: u=1, i',
            'referer: https://www.nobody-pro.com/',
            'sec-ch-ua: "Google Chrome";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: same-site',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function randomFloat($min, $max)
{
    return $min + ($max - $min) * (mt_rand() / mt_getrandmax());
}

/**
 * Desc :
 * User : you name
 * Date : 2025-01-04 17:58
 *
 * @param $lang
 *
 * @return false|string
 */
function buildvideodata_frist($sql)
{
    global $pdo;

    // 执行 SQL
    $pdo->exec($sql);

    // 获取最后插入的 ID
    return $pdo->lastInsertId();

}

function arrayToInsertSQL($data)
{
    $table = 'vs_dramas_video';
    // 提取字段名和对应的值
    $columns = implode(',', array_keys($data));
    $values  = implode(',', array_map(function ($value) {
        return is_string($value) ? "'" . addslashes($value) . "'" : $value;
    }, $data));

    // 构建 SQL 语句
    return "INSERT INTO $table ($columns) VALUES ($values);";
}

/*
 * 转成mp4
 */
function m3u8Conversionmp4($m3u8Url, $mp4name, $vid)
{

// 网络地址的 M3U8 文件
//    $m3u8Url = 'http://example.com/path/to/video.m3u8';

// 输出 MP4 文件路径
    $FilePath = 'F:\BaiduNetdiskDownload\VTube\1.3\videos\\' . $vid;
// 构建 FFmpeg 命令
    echo $ffmpegCmd = "ffmpeg -i \"$m3u8Url\" -c copy \"$FilePath\\{$vid}_{$mp4name}.mp4\"";

    // 检查文件夹是否存在
    if (!is_dir($FilePath)) {
        // 尝试创建文件夹
        if (!mkdir($FilePath, 0777, true)) {

            echo "文件夹创建失败！请检查权限。";
        }
    }

// 执行命令
    exec($ffmpegCmd, $output, $returnVar);

// 检查结果
    if ($returnVar === 0) {

        echo $time = getMP4time($FilePath . '\\' . $vid . "_" . $mp4name . ".mp4");
        echo "\r\n";
        echo $mp4name . "转换成功！输出文件为：{$FilePath}";
        echo "\r\n";
        return $time;
    } else {
        echo "-----" . $mp4name . "转换失败！";
        print_r($output); // 打印错误信息
        echo "\r\n";
        return false;
    }

}

/**
 * Desc : 获取mp4的时长
 * User : you name
 * Date : 2025-01-04 16:14
 */
function getMP4time($videoFile)
{

// 构建 FFmpeg 命令
    echo $cmd = "ffmpeg -i \"$videoFile\"  2>&1";
    echo "\r\n";
// 执行命令并获取输出
    exec($cmd, $output, $returnVar);
    echo "\r\n";

    echo "\r\n";
    echo $returnVar;

    // 从输出中提取时长
    if (preg_match('/Duration: (\d{2}:\d{2}:\d{2}\.\d{2})/', $output[17], $matches)) {
        $duration = $matches[1]; // 时长格式为 "HH:MM:SS.SS"
        echo "视频时长为：$duration";
        return timeToSeconds($duration);
    } else {
        echo "无法解析视频时长！";
    }

}

function timeToSeconds($time)
{
    // 使用 ":" 分割时分秒部分
    list($hours, $minutes, $seconds) = explode(":", $time);

    // 将时、分、秒分别转换为秒并相加
    $totalSeconds = $hours * 3600 + $minutes * 60 + $seconds;

    return (float)$totalSeconds; // 返回总秒数
}

function writedata($filePath, $data)
{
//    $filePath = 'output.txt';
    echo $filePath;
// 要写入的内容
    $data = $data . PHP_EOL;

// 追加写入数据到文件
    if (file_put_contents($filePath, $data, FILE_APPEND) !== false) {
        echo "数据已成功追加到文件！";
    } else {
        echo "写入文件失败！";
    }
}

/**
 * Desc : 下载图片
 * User : you name
 * Date : 2025-01-04 16:19
 */
function downimg($imageUrl, $name, $videoid)
{
    echo $imageUrl;
    echo "\r\n";
//    $imageUrl = "https://example.com/image.jpg";

// 保存路径
    $savePath = "/video/images/" . $videoid . "/" . $name;
    $FilePath = 'F:\BaiduNetdiskDownload\VTube\1.3\images\\' . $videoid . "\\";
    // 检查文件夹是否存在
    if (!is_dir($FilePath)) {
        // 尝试创建文件夹
        if (!mkdir($FilePath, 0777, true)) {

            echo "文件夹创建失败！请检查权限。";
        }
    }
    $FilePath = $FilePath . $name;
// 获取图片内容
    $imageContent = file_get_contents($imageUrl);

    if ($imageContent !== false) {
        // 保存图片到本地
        if (file_put_contents($FilePath, $imageContent)) {
            echo "图片下载成功，保存路径为：$FilePath,数据库路径为$savePath";
            return $savePath;
        } else {
            echo "保存图片失败！";
        }
    } else {
        echo "下载图片失败！";
    }
}

function generateUUID()
{
    // 生成 16 字节（128 位）的随机数
    $data = random_bytes(16);

    // 设置 UUID v4 版本号（4 位）和变体（2 位）
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // 设置第7个字节为版本号 (0100xxxx)
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // 设置第9个字节的高2位为 10

    // 转换为标准 UUID 格式：8-4-4-4-12
    return sprintf(
        '%08x-%04x-%04x-%04x-%12s',
        bin2hex(substr($data, 0, 4)),  // 前 4 字节
        bin2hex(substr($data, 4, 2)),  // 接下来 2 字节
        bin2hex(substr($data, 6, 2)),  // 接下来 2 字节（包含版本号）
        bin2hex(substr($data, 8, 2)),  // 接下来 2 字节（包含变体）
        bin2hex(substr($data, 10, 6)) // 最后 6 字节
    );
}

function updatevideo($vid, $title)
{
    global $pdo;
//    echo $sql = "UPDATE `dev_admin_ksmovi`.`vs_dramas_video` SET `title` = '{$title}' WHERE `id` = {$vid}";
//    echo "\r\n";
//    // 执行 SQL
//    $pdo->exec($sql);
    $stmt = $pdo->prepare("UPDATE `vs_dramas_video` SET `title` = :title WHERE `id` = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':id', $vid);
    $stmt->execute();

}

/**
 * Desc :
 * User : you name
 * Date : 2025-01-04 17:58
 *
 * @param $lang
 *
 * @return false|string
 */
function buildvideodata($lang, $uuid)
{
    global $pdo;
    $sql = "   INSERT INTO `dev_admin_ksmovi`.`vs_dramas_video` ( `lang_id`, `category_ids`, `area_id`, `year_id`, `title`, `subtitle`, `image`, `image_h`, `media`, `flags`, `description`, `tags`, `content`, `price`, `vprice`, `episodes`, `score`, `sales`, `favorites`, `views`, `shares`, `likes`, `comments`, `fake_views`, `fake_favorites`, `fake_shares`, `fake_likes`, `weigh`, `M3U8`, `status`, `copyright_id`, `createtime`, `updatetime`, `deletetime`, `progress`, `source_uuid`) VALUES ( {$lang}, 75, 0, 2024, 'Accidentally Married To the Secret Billionaire', 'Accidentally Married To the Secret Billionaire', '/video/uploads/20250104/35f599024d836ee9b6be1f45a4f42130.webp', '', '', 'must,news,recommend', 'The heiress Tamara Quinn catches her fiance cheating on her sister, and she has only three days left to find a new husband to secure her fortune. By chance, she has a one-night stand with an escort from a bar, Liam Garrison, but is caught by her sister. Tamara has no choice but to pretend that Liam is her new husband—a noble man from France. To solidify this deception, Tamara marries Liam by contract and trains him to fit into high society. Everytime Tamara faces difficulties, Liam secretly helps her. However, as their relationship grows intimate, Tamara finds out that her husband is not an escort. His true identity is a billionaire', 'love,Urban Life', '', 0, 0, 55, '4.6', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'up', 0, 1736089918, 1736090316, NULL, 0,{$uuid});
";

    // 执行 SQL
    $pdo->exec($sql);

    // 获取最后插入的 ID
    return $pdo->lastInsertId();

}

$list       = fathergetdata();
$list       = json_decode($list)->data;
$fatherlist = [];
foreach ($list as $k => $v) {
    $newuuid             = generateUUID();
    $obj                 = [];
    $title               = $v->title;
    $title               = json_decode($title, true)['en'];
    $obj['lang_id']      = 3;
    $obj['category_ids'] = 75;
    $obj['area_id']      = 0;
    $obj['year_id']      = 2024;
    $obj['title']        = $title;
    $obj['subtitle']     = trim($title, '"');

    $videosimg           = downimg("https://r.nobody-pro.com" . $v->mainImg, $newuuid . '.png', $newuuid);
    $obj['image']        = $videosimg;
    $obj['flags']        = 'must,news,recommend';
    $obj['description']  = $v->description;
    $obj['tags']         = 'love,Urban Life';
    $obj['price']        = 500;
    $obj['vprice']       = 300;
    $obj['episodes']     = $v->totalEpisodes;
    $obj['score']        = randomFloat(.5, 5.0);
    $obj['favorites']    = rand(10, 100);
    $obj['views']        = rand(100, 1000);
    $obj['shares']       = rand(10, 100);
    $obj['likes']        = rand(10, 100);
    $obj['fake_views']   = rand(10, 100);
    $obj['status']       = 'up';
    $obj['createtime']   = time();
    $obj['updatetime']   = time();
    $videoUrlEN          = downimg($v->videoUrlEN, $newuuid . '.mp4', $newuuid);
    $obj['PreviewVideo'] = $v->videoUrlEN;
    $obj['source_uuid']  = $v->uuid;

    $sql     = arrayToInsertSQL($obj);
    $videoid = buildvideodata_frist($sql);

    $fatherlist[$k]['newuuid']   = $newuuid;
    $fatherlist[$k]['uuid']      = $v->uuid;
    $fatherlist[$k]['baseid']    = $videoid;
    $fatherlist[$k]['videosimg'] = $videoUrlEN;
}

$baselist = '[{"newuuid":"00000000-0000-0004-12dbf9ea00-c1836cc3b311","uuid":"d1c6138b-2ed6-44eb-9a78-18d39dfda312","baseid":"162","videosimg":"\/video\/images\/00000000-0000-0004-12dbf9ea00-c1836cc3b311\/00000000-0000-0004-12dbf9ea00-c1836cc3b311.mp4"},{"newuuid":"00000000-0000-0004-0000-aa11397aac2a","uuid":"5ad6d06c-56c8-47cc-b617-b28def411380","baseid":"163","videosimg":"\/video\/images\/00000000-0000-0004-0000-aa11397aac2a\/00000000-0000-0004-0000-aa11397aac2a.mp4"},{"newuuid":"00000000-0022-1058-0009-b37cd1077698","uuid":"2d7d2f05-e461-4dc2-8733-be6b14f40a08","baseid":"164","videosimg":"\/video\/images\/00000000-0022-1058-0009-b37cd1077698\/00000000-0022-1058-0009-b37cd1077698.mp4"},{"newuuid":"00000207-0005-0004-0008-d96fd1b176cb","uuid":"26fd5602-44c1-4cb2-9290-0e8efc3d44ca","baseid":"165","videosimg":"\/video\/images\/00000207-0005-0004-0008-d96fd1b176cb\/00000207-0005-0004-0008-d96fd1b176cb.mp4"},{"newuuid":"ac5165c900-016d-1136-2216-aef62bcbacb4","uuid":"46fa8026-5551-4559-9620-7aebfa34004f","baseid":"166","videosimg":"\/video\/images\/ac5165c900-016d-1136-2216-aef62bcbacb4\/ac5165c900-016d-1136-2216-aef62bcbacb4.mp4"},{"newuuid":"00000051-07cd-1310-26a7-c2e49c176fe0","uuid":"57b09285-2438-47c1-9f09-b08e75ee56b8","baseid":"167","videosimg":"\/video\/images\/00000051-07cd-1310-26a7-c2e49c176fe0\/00000051-07cd-1310-26a7-c2e49c176fe0.mp4"},{"newuuid":"00000035-0000-12c1-0000-c656fd3bb84e","uuid":"550a288f-7fb8-447a-9d26-6458b19ece6a","baseid":"168","videosimg":"\/video\/images\/00000035-0000-12c1-0000-c656fd3bb84e\/00000035-0000-12c1-0000-c656fd3bb84e.mp4"},{"newuuid":"0000026c-0006-128c-2191-4766d94f73f7","uuid":"520304b9-8652-4365-86e4-564278013119","baseid":"169","videosimg":"\/video\/images\/0000026c-0006-128c-2191-4766d94f73f7\/0000026c-0006-128c-2191-4766d94f73f7.mp4"},{"newuuid":"00004e20-0128-01bd-0000-bf13078d03ca","uuid":"c72923cd-15fd-4664-9b41-9f7f6b5de9d6","baseid":"170","videosimg":"\/video\/images\/00004e20-0128-01bd-0000-bf13078d03ca\/00004e20-0128-01bd-0000-bf13078d03ca.mp4"},{"newuuid":"00000000-0000-126e-0000-dc093fc3c413","uuid":"b6bf7e5c-3f27-4a86-8e99-26cb80cdb55e","baseid":"171","videosimg":"\/video\/images\/00000000-0000-126e-0000-dc093fc3c413\/00000000-0000-126e-0000-dc093fc3c413.mp4"},{"newuuid":"00000000-06e5-0fd3-0057-e0c3418e6b95","uuid":"d259ed71-e648-4f92-9344-c798256506c1","baseid":"172","videosimg":"\/video\/images\/00000000-06e5-0fd3-0057-e0c3418e6b95\/00000000-06e5-0fd3-0057-e0c3418e6b95.mp4"},{"newuuid":"00000001-0000-01be-0054-1b00a6c56be6","uuid":"b4eaaf36-b0cb-4ee0-b056-56b628072250","baseid":"173","videosimg":"\/video\/images\/00000001-0000-01be-0054-1b00a6c56be6\/00000001-0000-01be-0054-1b00a6c56be6.mp4"},{"newuuid":"00000000-02f1-0004-0000-39826782604b","uuid":"eccccd42-197a-48ff-85f7-52b9c53126f9","baseid":"174","videosimg":"\/video\/images\/00000000-02f1-0004-0000-39826782604b\/00000000-02f1-0004-0000-39826782604b.mp4"},{"newuuid":"00000373-0000-0198-0053-11a04ceae8df","uuid":"f50c6450-ef26-4bb4-9d5e-cafaef9725b7","baseid":"175","videosimg":"\/video\/images\/00000373-0000-0198-0053-11a04ceae8df\/00000373-0000-0198-0053-11a04ceae8df.mp4"},{"newuuid":"00000008-0009-1123-0000-fbdcffda88a1","uuid":"09a1273e-b437-4ad8-936f-4779ff57471e","baseid":"176","videosimg":"\/video\/images\/00000008-0009-1123-0000-fbdcffda88a1\/00000008-0009-1123-0000-fbdcffda88a1.mp4"},{"newuuid":"0000004f-01e3-11f8-0009-813f0fd12630","uuid":"22a95f7d-4ee7-4114-8f0e-4f5bd3a55f95","baseid":"177","videosimg":"\/video\/images\/0000004f-01e3-11f8-0009-813f0fd12630\/0000004f-01e3-11f8-0009-813f0fd12630.mp4"},{"newuuid":"00000004-0001-0031-0000-9d7fc1b07d78","uuid":"837c457b-5dd3-4d3d-9b01-74b1ce7b35bb","baseid":"178","videosimg":"\/video\/images\/00000004-0001-0031-0000-9d7fc1b07d78\/00000004-0001-0031-0000-9d7fc1b07d78.mp4"},{"newuuid":"00165e48-0000-0004-0000-cc52580369fd","uuid":"8aae832b-cf60-46e7-85a7-f18fe244af23","baseid":"179","videosimg":"\/video\/images\/00165e48-0000-0004-0000-cc52580369fd\/00165e48-0000-0004-0000-cc52580369fd.mp4"},{"newuuid":"00000000-0000-01ae-0000-c8416a8ff46c","uuid":"c51c9277-d4fa-4918-bdb3-beeda94789ad","baseid":"180","videosimg":"\/video\/images\/00000000-0000-01ae-0000-c8416a8ff46c\/00000000-0000-01ae-0000-c8416a8ff46c.mp4"},{"newuuid":"0000033a-0000-0004-0000-c1f5136235d8","uuid":"9e94983d-ff72-4146-8048-23242c3888df","baseid":"181","videosimg":"\/video\/images\/0000033a-0000-0004-0000-c1f5136235d8\/0000033a-0000-0004-0000-c1f5136235d8.mp4"}]';
$baselist = json_decode($baselist, true);
$baselist = $fatherlist;
foreach ($baselist as $k => $v) {
    $videobaseimg = $v['videosimg'];
    $baseid       = $v['baseid'];
    $uuid         = $v['uuid'];
    $bastnewuuid  = $v['newuuid'];
    $lang         = ["tw" => 4, "en" => 3, "th" => 5, "vi" => 9, "ja" => 11, "ko" => 12, "id" => 10];

#每部剧都需要获取一条新的sql
    $videoslist = [];
    $n          = 0;
    foreach ($lang as $key => $value) {
        if ($key == "en") {
            $videoslist[$n]['vid']  = $baseid;
            $videoslist[$n]['lang'] = "en";
        } else {
            $videoslist[$n]['vid']  = buildvideodata($value, $uuid);
            $videoslist[$n]['lang'] = $key;
        }

        $n++;
    }
    if (empty($videoslist)) {
        die();
    }

    if ($bastnewuuid) {
        $newuuid = $bastnewuuid;
    } else {
        $newuuid = generateUUID();
    }

    $apiurl  = "https://mapi.nobody-pro.com/nobodypro/api/playlet/getPlayletDetailsVip?uuid=";
    $m3u8Url = $apiurl . $uuid;
    $data    = getdata($uuid);
    $data    = json_decode($data);
//print_r($data);
    if ($data->code == 200) {
        $data = $data->data;
        echo $listtitle = $data->playletMainEntity->title;
        $listtitle = json_decode($listtitle);

        $freeEpisodesList = $data->freeEpisodesList;
        $videos           = [];

        #获取图片
        $imageUrl = $data->playletMainEntity->mainImg;
        if ($videobaseimg) {
            $videosimg = $videobaseimg;
        } else {
            $videosimg = downimg("https://r.nobody-pro.com" . $imageUrl, $newuuid . '.png', $newuuid);
        }

        $newlist = [];
        foreach ($videoslist as $kaa => $vid) {

            #更新不同语言包版本内容
            updatevideo($vid['vid'], $listtitle->{($vid['lang'])});

            if ($kaa == 0) {
                $newlist_ = [];
                #续集列表
                foreach ($freeEpisodesList as $k => $vule) {
                    #集数
                    $episodesNum = $vule->episodesNum;
                    #视频id
                    $videoUid = $vule->videoUid;
                    #生成mp4文件名
                    $mp4name = $newuuid . '_' . $episodesNum;
                    #视频名称
                    $time = m3u8Conversionmp4($videoUid, $episodesNum, $newuuid);
                    $dz   = rand(4000, 9999);
                    $cs   = rand(1000, 4000);
                    $zf   = rand(500, 1000);
                    $play = rand(5000, 10000);
                    $str  = $vid['vid'] . "," . $episodesNum . "," . "/video/videos/" . $newuuid . '/' . $mp4name . ".mp4,$videosimg," . $time . ",10,5,{$dz},{$cs},{$zf},{$play},0,$videoUid";
                    writedata('video.txt', $str);

                    $newlist_[$k]['episodesNum'] = $episodesNum;
                    $newlist_[$k]['name']        = "/videos/" . $newuuid . '/' . $mp4name . ".mp4";
                    $newlist_[$k]['videosimg']   = $videosimg;
                    $newlist_[$k]['time']        = $time;
                    $newlist_[$k]['dz']          = $dz;
                    $newlist_[$k]['cs']          = $cs;
                    $newlist_[$k]['zf']          = $zf;
                    $newlist_[$k]['play']        = $play;
                    $newlist_[$k]['m3u8']        = $videoUid;

                }
            } else {
                foreach ($newlist_ as $dd) {
                    $str = $vid['vid'] . "," . $dd['episodesNum'] . "," . $dd['name'] . "," . $dd['videosimg'] . "," . $dd['time'] . ",10,5," . $dd['dz'] . "," . $dd['cs'] . "," . $dd['zf'] . "," . $dd['play'] . ",0," . $dd['m3u8'];
                    writedata('video.txt', $str);
                }
            }
        }

    }
}
$pdo = null;