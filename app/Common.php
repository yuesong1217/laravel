<?php
/**
 * @Author: Marte
 * @Date:   2019-08-08 14:13:06
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-08-13 09:21:06
 */
    function upload($name)
    {
        if (request()->file($name)->isValid()) {         
            $photo = request()->file($name);         
         // $extension = $photo->extension();         
         //$store_result = $photo->store('photo');         
            $headimg = $photo->store('', 'public'); 
            return $headimg;        
         // $output = [             'extension' => $extension,             'store_result' => $store_result         ];         
         // print_r($output);exit();     
        }
            exit('未获取到上传文件或上传过程出错'); 
        
    }

    function createTree($data,$pid=0,$level=0)
    {
        static $arr=[];
        foreach ($data as $k => $v) {
            if ($v->pid==$pid) {
                $v->level=$level;
                $arr[]=$v;
                createTree($data,$v->cate_id,$level+1);
            }
        }
        return $arr;
    }

    function send($email,$info,$code)
    {
        //echo $info;die;
        \Mail::send('mail' , ['name'=>'岳松','code'=>$code] ,function($message)use($email,$info){
           // echo $info;die;
        //设置主题
            $message->subject($info);
        //设置接收方
            $message->to($email);
        });
}