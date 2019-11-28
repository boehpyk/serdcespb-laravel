<?php
/**
 * Class that makes cover images for the Event.
 * Cover file can be uploaded or generated (if not exists)
 * User: programmer
 * Date: 16/06/2019
 * Time: 14:12
 */

namespace App\Service;

use http\Exception\UnexpectedValueException;

class YoutubeParser
{
    /**
     * URL to get Ypoutube video information
     */
    const API_URL = 'https://www.googleapis.com/youtube/v3/videos';

    /**
     * My API key for using Youtube API
     */
    const API_KEY = 'AIzaSyDXgT_K3a0VNR5HW2UAjj6hWK8pLt6bXpU';

    public function parse(string $url):array
    {
        $result = [];

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        if (!$matches or !isset($matches[0])) {
            throw new UnexpectedValueException('Cannot find video using given URL');
        }
        $video_id = $matches[0];

        $curl = curl_init(self::API_URL . '?id=' . $video_id . '&key=' . self::API_KEY . '&part=snippet');
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1
        ]);
        $resp = curl_exec($curl);
        curl_close($curl);

        $arr = json_decode($resp, true);

        $result['code'] = $video_id;
        $result['title'] = $arr['items'][0]['snippet']['title'];

        return $result;
    }
}