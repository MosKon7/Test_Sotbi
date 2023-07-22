<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Yandex Maps");

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule("iblock");
?>



<div class="conteiner">
    <div class="pre">
        <? /* СОЗДАНИЕ ТИПА ИНФОБЛОКА */
        $arFields = Array(
            'ID'=>'moss_maps',
            'SECTIONS'=>'Y',
            'IN_RSS'=>'N',
            'SORT'=>100,
            'LANG'=>Array(
                'ru'=>Array(
                    'NAME'=>'Карты',
                    'SECTION_NAME'=>'Разделы',
                    'ELEMENT_NAME'=>'Объекты'
                ),
                'en'=>Array(
                    'NAME'=>'Maps',
                    'SECTION_NAME'=>'Sections',
                    'ELEMENT_NAME'=>'Objects'
                )
            )
        );
        $obBlocktype = new CIBlockType;// Создаём экземпляр объекта
        $typeIBlock = $obBlocktype->Add($arFields);
        
        if(!$typeIBlock){
            $DB->Rollback();
            echo 'Ошибка: '.$obBlocktype->LAST_ERROR.'<br>';
            return false;
        }else{
            echo 'Тип нформационного блока "ТЕСТ" создан<br>';
            $DB->Commit();
        }
        ?>

        <br>
        <? /* СОЗДАНИЕ ИНФОБЛОКА */
            $ib = new CIBlock;
            $arFields = Array(
                "ACTIVE" => "Y",
                "NAME" => "Карты",
                "CODE" => "moss_test_maps",
                "LIST_PAGE_URL" => " ",
                "SECTION_PAGE_URL" => " ",  // БЕЗ ЧПУ
                "DETAIL_PAGE_URL" => " ",
                "CANONICAL_PAGE_URL" => "",
                "IBLOCK_TYPE_ID" => "moss_maps",
                "SITE_ID" => Array("s1"),
                "SORT" => "500",
                "DESCRIPTION" => "",
                "DESCRIPTION_TYPE" => "text",
                "GROUP_ID" => Array("2"=>"R"), // 2 -все пользователи, R - чтение
                "LIST_MODE" => "",
                "SECTION_PROPERTY" => false,
                "WORKFLOW" => "N",
                "PROPERTY_INDEX" => "N",
                "EDIT_FILE_BEFORE" => "",
                "EDIT_FILE_AFTER" => "",
                "SECTIONS_NAME" => "Разделы",
                "SECTION_NAME" => "Раздел",
                "ELEMENTS_NAME"=> "Элементы",
                "ELEMENT_NAME" => "Элемент"
            );

            $ID = $ib->Add($arFields);
            if ($ID > 0){
                echo "Инфоблок \"Карты\" [".$ID."] успешно создан<br />";
            }else{
                echo "Ошибка создания инфоблока \"Карты\"<br />";
                return false;
            }

            // Добавляем свойства //
            // Определяем, есть ли у инфоблока свойства
            $dbProperties = CIBlockProperty::GetList(array(), array("IBLOCK_ID"=>$ID));
            if ($dbProperties->SelectedRowsCount() <= 0){
                $ibp = new CIBlockProperty;

                // Телефон
                $arFields = Array(
                    "NAME" => "Телефон",
                    "ACTIVE" => "Y",
                    "SORT" => 300,
                    "CODE" => "PHONE",
                    "PROPERTY_TYPE" => "S", // Строка
                    "ROW_COUNT" => 1, // Количество строк
                    "COL_COUNT" => 100, // Количество столбцов
                    "IBLOCK_ID" => $ID,
                );
                $propId = $ibp->Add($arFields);
                if ($propId > 0){
                    $arFields["ID"] = $propId;
                    $arCommonProps[$arFields["CODE"]] = $arFields;
                    echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
                }else{
                    echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
                }

                // Email
                $arFields = Array(
                    "NAME" => "Email",
                    "ACTIVE" => "Y",
                    "SORT" => 400,
                    "CODE" => "EMAIL",
                    "PROPERTY_TYPE" => "S", // Строка
                    "ROW_COUNT" => 1, // Количество строк
                    "COL_COUNT" => 100, // Количество столбцов
                    "IBLOCK_ID" => $ID,
                );
                $propId = $ibp->Add($arFields);
                if ($propId > 0){
                    $arFields["ID"] = $propId;
                    $arCommonProps[$arFields["CODE"]] = $arFields;
                    echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
                }else{
                    echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
                }

                //  Можно было бы использовать 
                //    и тип свойства яндекс координы,
                //    не разбивая на два свойства 
                //    или через запятую 
                
                // Координаты
                $arFields = Array(
                    "NAME" => "Координаты",
                    "ACTIVE" => "Y",
                    "SORT" => 500,
                    "CODE" => "COORD",
                    "PROPERTY_TYPE" => "S", // Строка
                    "ROW_COUNT" => 1, // Количество строк
                    "COL_COUNT" => 20, // Количество столбцов
                    "IBLOCK_ID" => $ID,
                );
                $propId = $ibp->Add($arFields);
                if ($propId > 0){
                    $arFields["ID"] = $propId;
                    $arCommonProps[$arFields["CODE"]] = $arFields;
                    echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
                }else{
                    echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
                }

                // Город
                $arFields = Array(
                    "NAME" => "Город",
                    "ACTIVE" => "Y",
                    "SORT" => 600,
                    "CODE" => "CITY",
                    "PROPERTY_TYPE" => "S", // Строка
                    "ROW_COUNT" => 1, // Количество строк
                    "COL_COUNT" => 100, // Количество столбцов
                    "IBLOCK_ID" => $ID,
                );
                $propId = $ibp->Add($arFields);
                if ($propId > 0){
                    $arFields["ID"] = $propId;
                    $arCommonProps[$arFields["CODE"]] = $arFields;
                    echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
                }else{
                    echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
                }

            }else{
                echo "&mdash; Для данного инфоблока уже существуют свойства<br />";  
            }   
        ?>

        <br>
        <?
        for ($i=0; $i < 6; $i++) { 
            $cord_x = rand(50, 60);
            $cord_y = rand(30, 40);

            $el = new CIBlockElement;
            $PROP = array(
                "PHONE" => "+7 (999) 999 99 99",
                "EMAIL" => "test@email.ru",
                "COORD" => $cord_x . ", " . $cord_y,
                "CITY" => "Город"
            );
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(),
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID"      => $ID,
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => "Точка №".$i,
                "ACTIVE"         => "Y"            // активен
            );
            if($PRODUCT_ID = $el->Add($arLoadProductArray))
                echo "Новый элемент [".$PRODUCT_ID ."] создан!<br>";
            else
                echo "Элемент не создан: ".$el->LAST_ERROR . "<br>";
        }
        ?>
    </div>
    <a href="/ymaps" class="btn">Посмотреть карту</a>
</div>

<style>
.conteiner{
    max-width: 1440px;
    margin: 3em ;
}
.conteiner .pre{
    margin: 3em 0 !important;
    font-size: 16px;
    font-weight: 400;
}
.conteiner .btn{
    font-size: 18px;
    background-color: #d9d9d9;
    color: black;
    text-align: center;
    padding: 15px 20px;
    cursor: pointer;
    text-decoration: none;
    margin: 0;
}
</style>