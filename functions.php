<?php
    function read_file(){
        $itemList = fopen("files/items.txt", "r");
        $allItems = array();

        if ($itemList){
            while (!feof($itemList)){
                $tempArray = array(
                    'name' => fgets($itemList),
                    'type' => fgets($itemList),
                    'quantity' => fgets($itemList),
                    'price' => fgets($itemList),
                    'imageLocation' => fgets($itemList)
                );

                array_push($allItems, $tempArray);
            }
        }
        fclose($itemList);
        usort($allItems, 'type_compare');

        return $allItems;
    }

    function save_file($allItems){
        $itemList = fopen("files/items.txt", "w");

        //save file
        for($i = 0; $i < sizeof($allItems); $i++){
            fwrite($itemList, trim($allItems[$i]['name']));
            fwrite($itemList, PHP_EOL);
            fwrite($itemList, trim($allItems[$i]['type']));
            fwrite($itemList, PHP_EOL);
            fwrite($itemList, trim($allItems[$i]['quantity']));
            fwrite($itemList, PHP_EOL);
            fwrite($itemList, trim($allItems[$i]['price']));
            fwrite($itemList, PHP_EOL);
            fwrite($itemList, trim((string)$allItems[$i]['imageLocation']));
            if ($i !== (sizeof($allItems)-1)){
                fwrite($itemList, PHP_EOL);
            }
        }

        fclose($itemList);
    }

    function add_item($newItem, $param, &$allItems){
        //add new item
        if($param === null){
            array_push($allItems, $newItem);
        }
        //modify item
        else{
            //perform splice
            $index = (int)$param;
            array_splice($allItems, $index, 1, array($newItem));
        }
    }

    function display_items(&$allItems, $filter){
        //perform sort before each table load in case of modifications
        $filterTypes = array('CPU', 'RAM', 'Motherboard', 'GPU');

        for($i = 0; $i < sizeof($allItems); $i++){
            //filtering
            if($filter && $filter == in_array($filter, $filterTypes)){
                if($filter != trim($allItems[$i]['type'])){
                    continue;
                }
            }

            //display table
            $button = $allItems[$i]['quantity'] > 0 ? "<input class='add-to-cart' type='submit' value='Add to cart' >"
                : "<label class='out-of-stock'>OUT OF STOCK</label>";
            $quantityMax = (int)$allItems[$i]['quantity'];
            $quantityPicker = $quantityMax > 0 ? "<input style='display: inline-block' type='number' name='purchaseQuantity' min='1' max='{$quantityMax}'>" : "";

            //use heredoc
            echo <<<HTML
           
                <article>
                    <form action="." method="post">
                        <img src="{$allItems[$i]['imageLocation']}" alt="{$allItems[$i]['name']}">
                        <section>
                            {$allItems[$i]['name']}
                            <section>
                            \${$allItems[$i]['price']}
                                <section>{$allItems[$i]['quantity']} in stock</section>
                            </section>    
                            <input type="hidden" name="index" value="{$i}">
                            {$quantityPicker}
                            {$button}
                        </section>                        
                    </form>                    
                </article>                        
HTML;
        }
    }

    function type_compare($a, $b){
        if ($a == $b)
            return 0;
        return ($a['type'] < $b['type']) ? -1 : 1;
    }
