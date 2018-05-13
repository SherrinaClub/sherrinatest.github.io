<!DOCTYPE html>
<html lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>食物热量查询</title>
        <!-- 引入 WeUI -->
        <link rel="stylesheet" href="../weui.min.css"/>
    </head>
    <body>
        <!-- 使用 -->     
        <br/>
        <div class="weui-search-bar" id="search_bar">
       		<form class="weui-search-bar__form"  id="frmsearch" action="" method="post">
      			<div class="weui-search-bar__box">
           			<i class="weui-icon-search"></i>
            		<input type="search" class="weui-search-bar__input" id="search_input" name="search_input" placeholder=">> 搜索" required/>
          			<a href="javascript:" class="weui-icon-clear" id="search_clear"></a>
      			</div>
      			<label for="search_input" class="weui-search-bar__label" id="search_text">
            		<i class="weui-icon-search"></i>
            		<span onclick="return formSubmit('frmsearch');">搜索</span>
       			</label>
   			</form>
        </div>   
        <br/>
        
        
        <?php
        	function xtext(){
				$code = $_REQUEST['code']; //获取前端传过来的code值
   				echo $code.'——这是打印出来的';
            }
        
        
			$name = $_POST['search_input'];//获得用户请求的食物名称
			
			echo "<div class=\"weui-cells__title\">查询结果</div>";

            //		用户名　 :  SAE_MYSQL_USER
            //		密　　码 :  SAE_MYSQL_PASS
            //		主库域名 :  SAE_MYSQL_HOST_M
            //		从库域名 :  SAE_MYSQL_HOST_S
            //		端　　口 :  SAE_MYSQL_PORT
            //		数据库名 :  SAE_MYSQL_DB
            //		使用方法，以MySQL模块为例:    

			// 连主库
			$db = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

			$number = 0;//记录查询到的结果数量
			if ($db) {
    			mysql_select_db(SAE_MYSQL_DB, $db);
                $query = "select * from Food where name = '".$name."';";//精确查询名字等于用户输入的食物
   			 	if($r = mysql_query($query, $db)){
                    
                    echo "<div class=\"weui-cells weui-cells_access\">";//将查询结果显示出来
        			while($row = mysql_fetch_array($r)){
                        $number++;
                        $foodid = $row['foodid'];
                        $energy = $row['energy'];
                        //链接跳转到食物信息具体显示页面，所附参数为食物id
                        echo "<a class=\"weui-cell\" href=\"../food.php?foodid='".$foodid."'\">
        					  	<div class=\"weui-cell__bd weui-cell__primary\">
            						<p>".$name."</p>
        						</div>
        						<div class=\"weui-cell__ft\">".$energy."大卡/100克</div>
    						  </a>";  
       	 			}
    			}
                
                $more_query = "select * from Food where name like '%".$name."%';";//模糊查询名字含有用户输入的食物
   			 	if($more_r = mysql_query($more_query, $db)){
        			while($more_row = mysql_fetch_array($more_r)){
                        $number++;
                        $full_name = $more_row['name'];
                        $energy = $more_row['energy'];
                        $more_foodid = $more_row['foodid'];
                        if($full_name != $name){
                            ////链接跳转到食物信息具体显示页面，所附参数为食物id
        					echo "<a class=\"weui-cell\" href=\"../food.php?foodid='".$more_foodid."'\">
        							<div class=\"weui-cell__bd weui-cell__primary\">
            							<p>".$full_name."</p>
        							</div>
        							<div class=\"weui-cell__ft\">".$energy."大卡/100克</div>
    							</a>";
                        }
                      
       	 			}
    			} 
                echo "</div>"; 
                
                if($number == 0){//若未查询到相关结果
        			echo "<div class=\"weui-cells weui-cells-access\">
        				  	<a class=\"weui-cell\" href=\"#\">
        					  	<div class=\"weui-cell__bd weui-cell__primary\">
            						<p>未查询到相关结果</p>
        						</div>
        						<div class=\"weui-cell__ft\"></div>
    						</a>
               			  </div>
                          <br/><br/><br/><br/><br/><br/>";
                      
       	 		}
                else if($number < 8){//查询到相关结果，输出适量<br/>来美化界面
                    for($i = 8 - $number; $i > 0; $i--) echo "<br/>";
                }
			}

		?>
        <img src="http://1.shapemania.applinzi.com/food.jpg" alt="" width="390"/>
        
        <!--搜索框的实现代码-->
        <script type="text/javascript">
			var $ = function(id){
            			return document.getElementById(id);
        			}
			var formSubmit = function(id){
								document.forms[id].submit();
								return false;
							}
			var tip = function(q, for_q){
						q = $(q);
						for_q = $(for_q);
						q.onfocus = function(){
										for_q.style.display = 'none';
										q.style.backgroundPosition = "right -17px";
									}
						q.onblur = function(){
										if(!this.value) for_q.style.display = 'block';
										q.style.backgroundPosition = "right 0";
                                   }//当用户离开input输入框时执行一段Javascript代码
						for_q.onclick = function(){
											this.style.display = 'none';
											q.focus();
										}
					};
			tip('search_input','search_text');
		</script>
    </body>
</html>