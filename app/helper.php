


<?php
//يعنى بيقول نفذها مره واحده بس مش كل ما تستدعيها تنفذها
if(!function_exists('SuccessResponse'))
{
function SuccessResponse($message=null,$data=null)

{
    $respose=[
        'status'=>true,
        "message"=>$message,
        'data'=>$data
    ];
    return response()->json($respose);
}
}

if(!function_exists('FailResponse'))
{
function FailResponse($message=null,$data=null)
{
    $respose=[
        'status'=>false,
        "message"=>$message,
        'data'=>$data
    ];
    return response()->json($respose);
}
}