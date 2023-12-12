<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StreamVideoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function getVideo($video_name)
    {
        // $video_name = $video->url;
        $file = Storage::disk('public')->path($video_name);

        $mime = 'video/mp4';
        $size = filesize($file);
        $length = $size;
        $start = 0;
        $end = $size - 1;

        $headers = [
            'Content-type' => $mime,
            'Accept-Ranges' => 'bytes',
        ];

        if (isset($_SERVER['HTTP_RANGE'])) {
            $c_start = $start;
            $c_end = $end;

            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

            if (strpos($range, ',') !== false) {
                return Response::make('', 416, $headers);
            }

            if ($range == '-') {
                $c_start = $size - substr($range, 1);
            } else {
                $range  = explode('-', $range);
                $c_start = $range[0];
                $c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
            }

            $c_end = ($c_end > $end) ? $end : $c_end;

            if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
                return Response::make('', 416, $headers);
            }

            $headers = [
                'Content-type' => $mime,
                'Accept-Ranges' => 'bytes',
                'Content-Range' => 'bytes ' . $c_start . '-' . $c_end . '/' . $size,
                'Content-Length' => $c_end - $c_start + 1,
            ];

            $start = $c_start;
            $end = $c_end;
            $length = $end - $start + 1;
        }

        $headers['Content-Range'] = 'bytes ' . $start . '-' . $end . '/' . $size;
        $headers['Content-Length'] = $length;

        return Response::stream(
            function () use ($file, $start, $end) {
                $fh = fopen($file, 'rb');
                $buffer = 1024 * 8;

                fseek($fh, $start);

                while (true) {
                    if (ftell($fh) >= $end) {
                        break;
                    }

                    set_time_limit(0);

                    echo fread($fh, $buffer);

                    flush();
                }

                fclose($fh);
            },
            206,
            $headers
        );
    }
}
