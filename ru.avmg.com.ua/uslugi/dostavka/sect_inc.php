<h3>Заказ по телефону: </h3>
<p>м. (067) 630-44-58</p>
<p>м. (067) 235-78-82</p>
<h3>Оформить заявку он-лайн</h3>
<?
$APPLICATION->IncludeComponent
	(
	"bitrix:form.result.new", "av",
		array(
		"AJAX_MODE"           => "Y",
		"AJAX_OPTION_JUMP"    => "N",
		"AJAX_OPTION_STYLE"   => "N",
		"AJAX_OPTION_HISTORY" => "N",

		"SEF_MODE"    => "N",
		"WEB_FORM_ID" => 23,

		"START_PAGE"     => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL"    => "",

		"SHOW_ANSWER_VALUE"      => "N",
		"SHOW_ADDITIONAL"        => "N",
		"SHOW_STATUS"            => "N",
		"EDIT_ADDITIONAL"        => "N",
		"EDIT_STATUS"            => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS"    => "N",

		"CACHE_TYPE" => "A",
		"CACHE_TIME" => 360000
		)
	);
?>