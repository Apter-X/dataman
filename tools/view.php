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
function display_table($arr, $keyId, $route = NULL)
{
    $i = 0;
    $count = count($arr);
    $police = POLICE_PRIMARY;
    ?>
    <div style='font-family:<?= $police ?>'>
        <table style='border: 1px solid black; border-collapse: collapse; font-family:<?= $police ?>; width: 100%'>
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
                            <a href='<?= $route ?>?id=<?= $arr[$i][$keyId] ?>'><?= "Details" ?></a>
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
 function display_row($arr, $keyId, $route = NULL)
 {
    $police = POLICE_PRIMARY;

    ?>
    <div style='font-family:<?= $police ?>'>
        <table style='border: 1px solid black; border-collapse: collapse; font-family:<?= $police ?>; width: 100%'>
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
                            <a href='<?= $route ?>?id=<?= $arr[$keyId] ?>'><?= "Details" ?></a>
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
function alert($string, $color = PRIMARY_COLOR)
{
    $police = POLICE_PRIMARY;

    $message = <<<EOT
        <div style="
            font-family: $police;
            border: 1px solid black; 
            position: relative;
            width: 100%;
            background-color: $color
        ">
            <p style="
                text-align: center; 
                color: white
            ">$string</p>
        </div>
    EOT;

    echo $message;
}

//error handler function
function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr";
    die();
}
