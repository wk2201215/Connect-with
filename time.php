<?php
//○秒前
echo date("Y-m-d H:i:s",strtotime("-1 second"));
//○分前
echo  date("Y-m-d H:i:s",strtotime("-1 minute"));
//○時間前
echo date("Y-m-d H:i:s",strtotime("-1 hour"));
//○日前
echo date("Y-m-d H:i:s",strtotime("-1 day"));
//○週間前
echo date("Y-m-d H:i:s",strtotime("-1 week"));
//○ヶ月前
echo date("Y-m-d H:i:s",strtotime("-1 month"));
//○年前
echo date("Y-m-d H:i:s",strtotime("-1 year"));
?>