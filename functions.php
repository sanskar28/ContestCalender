<?php


function UpdateSiteContest($data,$prevdata,$timezone){
    for ($x = 0; $x < sizeof($data['objects']); $x++) {
        $capi = new GoogleCalendarApi();
        $access_token = $_SESSION['access_token'];

        $calendar_id = 'primary';
        $event_title = $data['objects'][$x]['event'];
        if(in_array($event_title,$prevdata)){
            continue;
        }
        $full_day_event = 0; 
        $event_time = [ 'start_time' => $data['objects'][$x]['start'], 'end_time' => $data['objects'][$x]['end'] ];

        // Create event on primary calendar
        $event_id = $capi->CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $timezone, $access_token);
      
    }
}
function getdata($id,$date){
    $cr = curl_init();
    curl_setopt($cr,CURLOPT_URL,'https://clist.by:443/api/v1/contest/?username=sanskar28&api_key=67b6ecbea38666e1d1a59111aeadab5cbbfcbf1f&limit=10&resource__id='.$id.'&start__gt='.$date.'&order_by=start');
    curl_setopt($cr, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($cr,CURLOPT_RETURNTRANSFER,1);
    
    $val= curl_exec($cr);

    
    if($e=curl_error($cr)){
        echo $e;
    }
    curl_close($cr);
    $val1 = json_decode($val,true);
    return $val1;
}
?>