<?php
session_start();
header('Content-type: application/json');


require_once('google-calendar-api.php');
require_once('functions.php');

try {

    $sites=$_POST['sites'];

    $capi = new GoogleCalendarApi();


    $prevdata = $capi->GetEventList($_SESSION['access_token']);
    $summary=array();
    for($x=0;$x<sizeof($prevdata);$x++){
        array_push($summary,$prevdata[$x]['summary']);
    }
    if($sites['codeforces']=='yes'){
        $data = getdata(1,date("Y-m-d")."T".date("H:i:s"));
        UpdateSiteContest($data,$summary,'Etc/UCT');    
    }
    if($sites['codechef']=='yes'){
        $data = getdata(2,date("Y-m-d")."T".date("H:i:s"));
        UpdateSiteContest($data,$summary,'Etc/UCT');    
    }
    if($sites['leetcode']=='yes'){
        $data = getdata(102,date("Y-m-d")."T".date("H:i:s"));
        UpdateSiteContest($data,$summary,'Etc/UCT');    
    }
    if($sites['topcoder']=='yes'){
        $data = getdata(12,date("Y-m-d")."T".date("H:i:s"));
        UpdateSiteContest($data,$summary,'Etc/UCT');    
    }
    if($sites['hackerearth']=='yes'){
        $data = getdata(73,date("Y-m-d")."T".date("H:i:s"));
        UpdateSiteContest($data,$summary,'Etc/UCT');    
    }

	echo json_encode([ 'event_id' => "Successfull" ]);
}
catch(Exception $e) {
	header('Bad Request', true, 400);
    echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
}

?>