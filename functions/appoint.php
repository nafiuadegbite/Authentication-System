<?php

function get_appointments() {
    $allAppointment = scandir("db/appointments/");
    $countAllAppointment = count($allAppointment);

    for ($counter = 0; $counter < $countAllAppointment ; $counter++) {
        $appointment = file_get_contents('db/appointments/' . $allAppointment[$counter]);
        $appointmentObject = json_decode($appointment);

        return $appointmentObject;
    } 
    return false;     
}


function save_appointment($appointmentObject){
    file_put_contents("db/appointments/". $appointmentObject['id'] . ".json", json_encode($appointmentObject));
}