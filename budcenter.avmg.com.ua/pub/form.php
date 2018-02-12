<?php

define('SKIP_TEMPLATE_AUTH_ERROR', true);
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetPageProperty("BodyClass", "flexible-middle-width");
$APPLICATION->AddHeadString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
echo '###';
$APPLICATION->IncludeComponent(
	"bitrix:crm.webform.fill",
	"",
	array(),
	null,
	array("HIDE_ICONS" => "Y")
);

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php';