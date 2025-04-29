<?php
$tasmotapm_cfg = parse_ini_file( "/boot/config/plugins/tasmotapm-ng/tasmotapm-ng.cfg" );
$tasmotapm_device_ip	= isset($tasmotapm_cfg['DEVICE_IP']) ? $tasmotapm_cfg['DEVICE_IP'] : "";
$tasmotapm_use_pass	= isset($tasmotapm_cfg['DEVICE_USE_PASS']) ? $tasmotapm_cfg['DEVICE_USE_PASS'] : "false";
$tasmotapm_device_user	= isset($tasmotapm_cfg['DEVICE_USER']) ? $tasmotapm_cfg['DEVICE_USER'] : "";
$tasmotapm_device_pass	= isset($tasmotapm_cfg['DEVICE_PASS']) ? $tasmotapm_cfg['DEVICE_PASS'] : "";
$tasmotapm_costs_price	= isset($tasmotapm_cfg['COSTS_PRICE']) ? $tasmotapm_cfg['COSTS_PRICE'] : "0.0";
$tasmotapm_costs_unit	= isset($tasmotapm_cfg['COSTS_UNIT']) ? $tasmotapm_cfg['COSTS_UNIT'] : "USD";
$tasmotapm_costs_unit	= isset($tasmotapm_cfg['COSTS_UNIT']) ? $tasmotapm_cfg['COSTS_UNIT'] : "USD";
$tasmotapm_costs_display = isset($tasmotapm_cfg['COSTS_DISPLAY']) ? $tasmotapm_cfg['COSTS_DISPLAY'] : "true";

if ($tasmotapm_device_ip == "") {
	die("Tasmota Device IP missing!");
}

$Url = "http://" . $tasmotapm_device_ip . "/cm?";

if ($tasmotapm_use_pass == 1) {
	if ($tasmotapm_device_user == "") {
		die("Tasmota username missing!");
	}
	if ($tasmotapm_device_pass == "") {
		die("Tasmota password missing!");
	}

	$Url = $Url . "user=" . $tasmotapm_device_user . "&password=" . $tasmotapm_device_pass . "&";
}

$Url = $Url . "cmnd=Status%208";

$datajson = file_get_contents($Url);
$data = json_decode($datajson, true); 
$json = $data['StatusSNS']['ENERGY'];

if ($tasmotapm_costs_display) {
	$json['Costs_Price'] = $tasmotapm_costs_price;
	$json['Costs_Unit'] = $tasmotapm_costs_unit;
	$json['Costs_Display'] = $tasmotapm_costs_display;
}

header('Content-Type: application/json');
echo json_encode($json);
?>