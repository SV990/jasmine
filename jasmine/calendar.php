<?php
/**
* 日历
*
* @package custom
* @author 18.CX
* @version 1.0.0
* @link http://www.18.cx
*/
if (!defined("__TYPECHO_ROOT_DIR__")) {
  exit();
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <?php $this->need("header.php"); ?>
    <style>
        .calendar {
            font-family: Arial, sans-serif;
        }
        .calendar h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .calendar table {
            width: 100%;
            border-collapse: collapse;
        }
        .calendar th, .calendar td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }
        /* 修改：今天的日期样式，突出显示 */
        .calendar .today {
            background-color: #f0e4ff; /* 淡紫色背景 */
            color: red; /* 红色文字 */
            font-weight: bold; /* 加粗文字 */
            border: 2px solid #9e49b3; /* 明显的边框 */
            border-radius: 50%; /* 圆形边框 */
        }
    </style>
</head>
<body class="jasmine-body" data-prismjs-copy="点击复制" data-prismjs-copy-error="按Ctrl+C复制" data-prismjs-copy-success="内容已复制！">
<div class="jasmine-container grid grid-cols-12">
    <?php $this->need("header.php"); ?>
    <?php $this->need("component/sidebar-left.php"); ?>
    <div class="flex col-span-12 lg:col-span-8 flex-col lg:border-x-2 border-stone-100 dark:border-neutral-600 lg:pt-0 lg:px-6 pb-10 px-3">
        <?php $this->need("component/menu.php"); ?>
        <div class="flex flex-col gap-y-12">
            <div></div>
            <?php $this->need("component/post-title.php"); ?>

            <!-- 日历代码开始 -->
            <div>
                <?php
                $now = time(); // 当前时间戳
                $currentYear = date('Y', $now);
                $currentMonth = date('m', $now);
                $firstDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); // 星期天为0
                $totalDaysOfMonth = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

                // 定义星期的名称
                $weekDays = ['日', '一', '二', '三', '四', '五', '六'];

                echo '<div class="calendar">';
                echo '<h2>' . $currentYear . '年' . $currentMonth . '月</h2>';
                echo '当前日期为: ' . date('Y年m月d日') . '';
                echo '<table>';
                // 添加星期标题行
                echo '<tr>';
                foreach ($weekDays as $day => $name) {
                    echo '<th>' . $name . '</th>';
                }
                echo '</tr>';

                // 生成日历主体
                for ($week = 0; $week < 6; ++$week) {
                    echo '<tr>';
                    for ($day = 0; $day < 7; ++$day) {
                        $dayNum = ($week * 7 + $day + 1) - $firstDayOfMonth;
                        if ($dayNum < 1) {
                            echo '<td></td>'; // 月初前的空白
                        } else if ($dayNum > $totalDaysOfMonth) {
                            echo '<td></td>'; // 月末后的空白
                        } else {
                            $isToday = (date('Y-m-d') == $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($dayNum, 2, '0', STR_PAD_LEFT));
                            $classAttr = $isToday ? 'class="today"' : '';
                            echo '<td ' . $classAttr . '>' . $dayNum . '</td>';
                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
                ?>
            </div>
            <!-- 日历代码结束 -->

            <div class="border-b-2 border-stone-100 dark:border-neutral-600"></div>
            <?php $this->need("comments.php"); ?>
        </div>
    </div>
    <div class="hidden lg:col-span-3 lg:block" id="sidebar-right">
        <?php $this->need("component/sidebar.php"); ?>
    </div>
</div>
<?php $this->need("footer.php"); ?>
</body>
</html>