<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
    .user1 {
        width: 204px;
		height: 204px;
		left: 300px;
    	position: absolute;
        border: 1px solid #000000;
	}
	.user2 {
        margin: auto;
        width: 204px;
		height: 204px;
		left: 600px;
        border: 1px solid #000000;
        position: absolute;
    }
    
    div.item {
        width: 100px;
        height: 100px;
        border-radius: 5px;
        float: left;
        border: 1px solid lightgray;
        z-index: 1;
        text-align: center;
        font-size: 30px;
        line-height: 100px;
        cursor: move;
    }
    
    div.moving {
        border: 1px dashed gray;
    }
    
    div.draging {
        width: 100px;
        height: 100px;
        position: absolute;
        box-shadow: 0 0 2px 2px #555;
        border-radius: 5px;
        z-index: 500;
	}
	img{
		width: 100px;
        height: 100px;
	}
    </style>
</head>

<body>
    <div class="user1">
        <div class="item"><img src="./img/1.svg"></div>
        <div class="item"><img src="./img/3.svg"></div>
        <div class="item"><img src="./img/2.svg"></div>
        <div class="item"><img src="./img/1.svg"></div>
	</div>
	<div class="user2">
        <div class="item"><img src="./img/1.svg"></div>
        <div class="item"><img src="./img/3.svg"></div>
        <div class="item"><img src="./img/2.svg"></div>
        <div class="item"><img src="./img/1.svg"></div>
    </div>
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


    <script type="text/javascript">
	var bstop = true;
	var id = 2;
    $('.user' + id + ' div').on('mousedown', function(e) {
        if (bstop) {
            bstop = false;
            var that = this;
            var disx = e.offsetX; //获取的拖拽过程的短线的长度（鼠标的位置离盒子边缘的位置）
            var disy = e.offsetY;
            var clone = $(this).clone(); //克隆
            clone.addClass('draging').css({ //对克隆的盒子设置类名以及位置
                left: $(this).position().left,
                top: $(this).position().top
            });
            $('.user'+id).append(clone); //追加到user里面
            $(this).addClass('moving').html(''); //被克隆的元素添加类移除内容
            $('.user'+id).on('mousemove', function(e) { //对克隆的盒子进行拖拽
                clone.css({
                    left: e.pageX - $(this).offset().left - disx,
                    top: e.pageY - $(this).offset().top - disy
                })
               
            });

            clone.on('mouseup', function() {
                $('.user'+id).off('mousemove'); //取消mousemove事件
                var minIndex = $(that).index(); //最小索引赋初始值
                var minValue = 1000; //初始化最小值，用来存储所有盒子的最小值
                $('.user'+id+ ' div').not(':last').each(function() { //不包括克隆的那个盒子
                    var smalldistance = Math.sqrt(Math.pow(clone.position().left - $(this).position().left, 2) + Math.pow(clone.position().top - $(this).position().top, 2)); //利用勾股定理获取每一个盒子离克隆出来的盒子的距离
                    if (smalldistance < minValue) { //比较
                        minValue = smalldistance; //获取最小值
                        minIndex = $(this).index(); //获取最小值对应的索引
                    }
                });
                if (minIndex == $(that).index()) { //如果当前最小距离的那个盒子和拖拽的盒子索引相等的话，归位。
                    clone.animate($(that).position(), 400, function() {
                        $(that).removeClass('moving').html(clone.html()); //恢复被克隆盒子的相关样式
                        $(this).remove(); //移除被克隆的盒子
                        bstop=true;
                    });
                } else {
                    var $minbox = $('.user'+id+ ' div').eq(minIndex); //最小索引的盒子
                    var clone2 = $minbox.clone(); //克隆一个最小盒子的副本，添加相关样式
                    clone2.addClass('draging').css({
                        left: $minbox.position().left,
                        top: $minbox.position().top
                    })
                    $('.user'+id).append(clone2); //追加
                    $minbox.addClass('moving').html('');
                    clone.animate($minbox.position(), 400, function() { //克隆的内容运动到最小索引的盒子的位置
                        $minbox.removeClass('moving').html(clone.html()); //移除相关样式，添加内容
                        clone.remove(); //移除克隆的盒子
                        bstop = true;
                    });
                    clone2.animate($(that).position(), 400, function() {
                        $(that).removeClass('moving').html(clone2.html());
                        clone2.remove();
                        bstop = true;
                    });
                }
            });
        }
        return false;
    });
    </script>
</body>

</html>
