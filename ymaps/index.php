<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тестовое задание");
$APPLICATION->SetPageProperty("description", "Вывод списка объектов через Яндекс.Карты");

$APPLICATION->SetTitle("Тестовое задание");
?>

<?$APPLICATION->IncludeComponent(
	"moss:main.maps", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "moss_maps",
		"IBLOCK_ID" => "24",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>