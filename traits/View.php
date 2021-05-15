<?php
/**
 * Html constructor for debug
 */
trait View
{
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
    function displayTable($arr, $keyId = 'id', $route = NULL)
    {
        $i = 0;
        $count = count($arr);
        ?>
            <table id="datatable" style="width: 100%">
                <thead>
                    <tr>
                        <?php foreach($arr[0] as $key => $value) : ?>
                            <th><?=  $key ?></th>
                        <?php endforeach;?>
                        <th><?= "Action" ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($i < $count) : ?>
                        <tr>
                            <?php foreach ($arr[$i] as $key => $value) : ?>
                                <td>
                                    <div class="relative">
                                        <div class="value"><?= $value ?></div>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <a href='<?= $route ?>?id=<?= $arr[$i][$keyId] ?>'><?= "Details" ?></a>
                            </td>
                        </tr>
                    <?php $i++; endwhile; ?>
                </tbody>
            </table>
        <?php
    }

    /**
    * Display row
    */
    function displayRow($arr, $keyId = 'id', $route = NULL)
    {
        ?>
            <table id="datatable" style="width: 100%">
                <thead>
                    <tr>
                        <?php foreach($arr as $key => $value) : ?>
                            <th><?=  $key ?></th>
                        <?php endforeach;?>
                            <th><?= "Action" ?></th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <?php foreach ($arr as $key => $value) : ?>
                                <td>
                                    <div class="relative">
                                        <div class="value"><?= $value ?></div>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <a href='<?= $route ?>?id=<?= $arr[$keyId] ?>'><?= "Details" ?></a>
                            </td>
                        </tr>
                </tbody>
            </table>
        <?php
    }

    /**
    * Display Calendar
    */
    function displayCalendar($year, $dates, $date, $events, $route = null)
    {
        ?>
            <div class="periods">
                <div class="year"><?php echo $year; ?></div>
                <div class="months">
                    <ul>
                        <?php foreach ($date->months as $id=>$m): ?>
                            <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo substr($m,0,3); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="clear"></div> 
                <?php foreach ($dates as $m=>$days) : ?>
                <div class="month relative" id="month<?php echo $m ?>">
                    <table id="calendar">
                        <thead>
                            <tr>
                            <?php foreach ($date->days as $d): ?>
                                <th><?php echo substr($d,0,3); ?></th>
                            <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $end = end($days); foreach ($days as $d=>$w): ?>
                                    <?php $time = strtotime("$year-$m-$d"); ?>
                                    <?php if ($d == 1 and $w != 1): ?>
                                        <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                                    <?php endif; ?>
                                    <td <?php if($time == strtotime(date('Y-m-d'))): ?>class="today"<?php endif; ?>>
                                        
                                            <div class="relative">
                                            <div class="day"><a href=<?= "$route?date=$year-$m-$d"; ?>><?php echo $d; ?></a></div>
                                            </div>
                                            <div class="daytitle">
                                                <?php echo $date->days[$w-1]; ?> <?php echo $d ?> <?php echo $date->months[$m-1]; ?>
                                            </div>
                                        
                                        <ul class="events">
                                            <?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
                                                <li><?php echo $e; ?></li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </td>
                                    <?php if ($w == 7): ?>
                                        </tr><tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($end != 7): ?>
                                    <td colspan="<?php echo 7-$end; ?>" class="padding"></td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
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
            <div class="depop-alert" style="
                font-family: $police;
                border: 1px solid black; 
                position: absolute;
                width: 97%;
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
}
