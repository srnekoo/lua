<?php 

function enviar_mensagem($chatid, $message) {

    $curl = curl_init();
    $data=array(
        "phone" => $chatid,
        "body" => $message
    );
    $data=json_decode($data);

    curl_setopt_array($curl, array(
     CURLOPT_URL => 'http://api2.megaapi.com.br:15457/sendmessage?token=M_NrhbAOmvNOeNs',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>$data,
     CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
     ),
    ));
    
    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

function sendbuttonmessage($chatid, $message) {

    $curl = curl_init();
    $data =array(
    "phone"=> $chatid,
    "title"=> $message,
    "description"=> "Selecione uma das opções abaixo:",
    "type"=> "text",
    "buttons"=> ["Opção 1", "Opção 2", "Opção 3"]
    );
    $data=json_decode($data);

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://api2.megaapi.com.br:15457/sendmessage?token=M_NrhbAOmvNOeNs',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}

function cadastra_cliente($name, $chatid, $talento, $integrantes, $dia, $hora, $instagram){
    $sql = "INSERT INTO clientes (name, chatid, talento, integrantes, dia, hora, instagram) VALUES ('".$name."', '".$chatid."' '".$talento."''".$integrantes."''".$dia."''".$hora."''".$instagram.")";
    sc_exec_sql($sql);

}

function salva_historico($chatid, $talento, $integrantes, $dia, $hora, $instagram, $code){
    $sql = "INSERT INTO historico (phone, talento, integrantes, dia, hora, instagram, code) VALUES ('".$chatid."', '".$talento."', '".$integrantes."', '".$dia."', '".$horario."', '".$instagram."', '".$code."')";
    sc_exec_sql($sql);
}

function status_conversa($chatid){
    $sql = "SELECT COUNT(*) FROM historico WHERE phone = '".$chatid."'";
        sc_lookup(ds, $sql);
    if({ds} !== false) {
	    if({ds[0][0]} == 0) {
		    return false;
	    } else {
		return true;
	    }
    }
}

function verifica_cliente($chatid){
    $sql = "SELECT code FROM historico WHERE phone = '".$chatid."' ORDER BY id DESC";
    sc_lookup(ds, $sql);
        if({ds} !== false) {
	    return {ds[0][0]};
    }
}

