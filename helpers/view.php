<?php
/**
 * Formate debug
 *
 * @param [type] $var
 * @return void
 */
 function debug($var)
 {
    echo '<pre>';
        var_dump($var);
    echo '</pre>';
}

/**
 * Display table
 */
function display_table($arr, $id = NULL, $route = NULL)
{
    $i = 0;
    $count = count($arr);
    
?>
<div>
    <table style='border: 1px solid black; border-collapse: collapse;'>
        <thead>
            <tr>
                <?php foreach($arr[0] as $key => $value) : ?>
                    <th style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'><?=  $key ?></th>
                <?php endforeach;?>
                   <th style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'><?= "Action" ?></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($i < $count) : ?>
                <tr>
                    <?php foreach ($arr[$i] as $key => $value) : ?>
                        <td style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'>
                            <p><?= $value ?></p>
                        </td>
                    <?php endforeach; ?>
                    <td style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'>
                        <a href='<?= $route ?>?id=<?= $arr[$i][$id] ?>'><?= "Details" ?></a>
                    </td>
                </tr>
            <?php $i++; endwhile; ?>
        </tbody>
    </table>
</div>
<?php
}

/**
 * Display table
 */
 function display_row($arr, $id = NULL, $route = NULL)
 {
     $i = 0;
     $count = count($arr);
     
 ?>
 <div>
     <table style='border: 1px solid black; border-collapse: collapse;'>
         <thead>
             <tr>
                 <?php foreach($arr as $key => $value) : ?>
                     <th style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'><?=  $key ?></th>
                 <?php endforeach;?>
                    <th style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'><?= "Action" ?></th>
             </tr>
         </thead>
         <tbody>
                 <tr>
                     <?php foreach ($arr as $key => $value) : ?>
                         <td style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'>
                             <p><?= $value ?></p>
                         </td>
                     <?php endforeach; ?>
                     <td style='border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left;'>
                        <a href='<?= $route ?>?id=<?= $arr[$id] ?>'><?= "Details" ?></a>
                     </td>
                 </tr>
         </tbody>
     </table>
 </div>
 <?php
 }

/**
* Print warning
*/
function alert($string, $color = 'light-grey', $top = 0)
{
    $message = <<<EOT
        <div class="w3-panel w3-card w3-$color w3-animate-top alert-depop" style="position:absolute;width:100%;margin-top: $top;">
            <p style="text-align:center;">$string</p>
        </div>
    EOT;

    echo $message;
}
