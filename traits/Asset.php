<?php
/**
 * Stylize the data displaying
 */
trait Asset
{
    function dropStyle()
    {
        ?>
            <style>
                /*[fmt]0020-000A-3*/
                body{  background:#EEEEEE;  letter-spacing:1px;  font-family:<?= POLICE_PRIMARY ?>; padding:10px;}
                .year{  color:#D90000;  font-size:70px;}
                .relative{  position:relative;}
                .months{}
                .month{  margin-top:12px;}
                .months ul{  list-style:none;  margin:0px;  padding:0px;}
                .months ul li a{  float:left;  margin:-1px;  padding:0px 15px 0px 0px;  color:#888888;  text-decoration:none;  font-size:30px;  font-weight:bold;  text-transform:uppercase;}
                .months ul li a:hover, .months ul li a.active{  color:#D90000;}
                #calendar{  border-collapse:collapse;}
                #calendar td{  border:1px solid #A3A3A3;  width:80px;  height:70px;}
                #calendar td.today{  border:2px solid #D90000;  width:80px;  height:70px;}
                #calendar td.padding{  border:none;}
                #calendar td:hover{  background:#DFDFDF;  cursor:pointer;}
                #calendar th{  font-weight:normal;  color:#A8A8A8;}
                #calendar td .day{  position:absolute;  color:#8C8C8C;  bottom:-40px;  right:5px;  font-weight:bold;  font-size:24.3pt;}
                #calendar td .events{  position:relative;  width:79px;  height:0px;  margin:-30px 0px 0px;  padding:0px;}
                #calendar td .events li{  width:10px;  height:10px;  float:left;  background:#000;  /*+border-radius:10px;*/  -moz-border-radius:10px;  -webkit-border-radius:10px;  -khtml-border-radius:10px;  border-radius:10px 10px 10px 10px;  margin-left:6px; overflow:hidden;  text-indent:-3000px;}
                #calendar td:hover .events{  position:absolute;  left:582px;  top:66px;  width:442px;  list-style:none;  margin:0px;  padding:11px 0px 0px;}
                #calendar td:hover .events li{  height:40px;  line-height:40px;  font-weight:bold;  border-bottom:1px solid #D6D6D6;  padding-left:41px;  text-indent:0;  background:none;  width:500px;}
                #calendar td:hover .events li:first-child{  border-top:1px solid #D6D6D6;}
                #calendar td .daytitle{  display:none;}
                #calendar td:hover .daytitle{  position:absolute;  left:582px;  top:21px;  width:442px;  list-style:none;  margin:0px 0px 0px 16px;  padding:0px;  color:#D90000;  font-size:41px;  display:block;  font-weight:bold;}
                #datatable {  border-collapse: collapse;}
                #datatable td, #datatable th {  border: 1px solid #ddd;  padding: 8px;}
                #datatable tr:nth-child(even){background-color: #f2f2f2;}
                #datatable tr:hover {background-color: #ddd;}
                #datatable th {  padding-top: 12px;  padding-bottom: 12px;  text-align: left;  background-color: #D90000;  color: white;}
                .clear{  clear:both;}
            </style>
        <?php
    }
}
