<?php
/**
 * formated debug
 *
 * @param [type] $var
 * @return void
 */
 function debug($var){

    echo '<pre>';
        var_dump($var);
    echo '</pre>';
}

/**
 * Display table
 */
function display_table($array)
{
?>
<div>
    <table>
        <thead>
            <tr>
                <?php foreach($array as $key) : ?>
                    <th><?= $key ?></th> <!-- Keys -->
                <?php endforeach;?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($array as $key => $value) : ?>
                    <td>
                        <ul>
                            <li><?= $value ?></li> <!-- Values -->
                        </ul>
                    </td>
                <?php endforeach; ?>
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
