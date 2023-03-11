<?php
require_once 'Curl.php';


if($_POST['event'] === 'createEmployer'){
    $url = Curl::api().'employes/';
    $method= 'POST';
    $fields = json_encode( array('name'=>$_POST['name'], 'salary'=>$_POST['salary']));
    $resp = Curl::request($url,$method,$fields);
    echo json_encode($resp);

}else if($_POST['event'] === 'deleteEmploye'){
    $url = Curl::api().'employes/'.$_POST['id'];
    $method= 'DELETE';
    $fields = array();
    $resp = Curl::request($url,$method,$fields);
    echo json_encode($resp);

}else if($_POST['event'] === 'getEmploye'){
    $url = Curl::api().'employes/'.$_POST['id'];
    $method= 'GET';
    $fields = array();
    $resp = Curl::request($url,$method,$fields);
    echo json_encode($resp);
}else if($_POST['event'] === 'updateEmployee'){
    $url = Curl::api().'employes/'.$_POST['id'];
    $method= 'PATCH';
    $fields = json_encode( array('name'=>$_POST['nombre'], 'salary'=>$_POST['salario']));
    $resp = Curl::request($url,$method,$fields);
    echo json_encode($resp);
}


