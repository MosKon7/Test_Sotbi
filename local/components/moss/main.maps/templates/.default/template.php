<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$this->addExternalJS("https://api-maps.yandex.ru/2.1/?apikey=ваш API-ключ&lang=ru_RU");
?>
<?
/*Подключение  скриптов D7 в эпилоге*/
/* maps v3
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("https://api-maps.yandex.ru/v3/?apikey=ваш API-ключ&lang=ru_RU");*/
?>

<div class="conteiner">
    <div class="page">
        <div class="left_side">
            <div class="list_marker">
                <h2>Список мест</h2>
				<?if(!empty($arResult["ITEMS"])){?>
					<ul class="items">
						<?foreach($arResult["ITEMS"] as $key => $arItem) {?>
							<li class="item"
									data-name="<?=$arItem['NAME']?>"
									data-coord="<?=$arItem['COORD']['VALUE']?>"
									data-phone="<?=$arItem['PHONE']['VALUE']?>"
									data-email="<?=$arItem['EMAIL']['VALUE']?>">
								<div class="row">
									<p><?=$arItem["NAME"]?></p>
									<p><?=$arItem["CITY"]["VALUE"]?></p>
								</div>
								<div class="row">
									<a href="tel:<?=$arItem['PHONE']['VALUE']?>"><?=$arItem["PHONE"]["VALUE"]?></a>
									<a href="mailto:<?=$arItem['EMAIL']['VALUE']?>"><?=$arItem["EMAIL"]["VALUE"]?></a>
								</div>
							</li>
						<?}?>
					</ul>
				<?}else{?>
					<p class="err">Список пуст</p>
				<?}?>
            </div>
        </div>
        <div class="right_side">
            <div id="map"></div>
            <button class="btn_add_marker btn" onClick="setCenter()">Сбросить позицию карту</button>
        </div>
    </div>
</div>
