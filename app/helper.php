


<?php
function SuccessResponse($message=null,$data=null)
{
    $respose=[
        'status'=>true,
        "message"=>$message,
        'data'=>$data
    ];
    return response()->json($respose);
}

function FailResponse($message=null,$data=null)
{
    $respose=[
        'status'=>false,
        "message"=>$message,
        'data'=>$data
    ];
    return response()->json($respose);
}