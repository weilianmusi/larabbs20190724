<?php

namespace App\Handlers;

class ImageUploadHandler
{
    // 只允许一下后缀的文件上传
    protected $allowed_ext = ["png", "jpg", "gif", "jpeg"];

    public function save($file, $floder, $file_prefix, $max_width = false)
    {
        // 构建文件的存储规则，例如： uploads/images/avatars/20170908/21/
        // 文件夹切割，能让文件查询效率更高
        $foloder_name = "uploads/images/$floder/" . date("Ymd", time());

        // 文件具体存储的物理路径
        $upload_path = public_path() . '/' . $foloder_name;

        // 获取文件的后缀名，因为从剪贴版上，后缀名为空，所以此处保证后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关模型的 ID
        // 如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        // 如果限制了图片的宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$foloder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = \Image::make($file_path);

        // 进行大小的调整
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width ，高度等比例缩放,
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后保存
        $image->save();
    }
}