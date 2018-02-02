var wsUri = "ws://192.168.106.138:9300";
var output;
var websocket = new WebSocket(wsUri);
var id = '';
var raisemax = '';
var raisemin = '';
var user = new Array();

websocket.onopen = function(e) {
    $('.web').click();
    log("連線成功");
};
websocket.onmessage = function(e) {
    if (isJSON(e.data)) {
        data = JSON.parse(e.data);

        switch (data.action) {
            case "index_id":
                id = data.id;

                break;
            case "ready":
                log("收到服务端的消息：" + data.name + "已準備");
                if (data.onlinegame[0] == id && data.gameing == 0) {
                    $('.start').show();
                }
                break;
            case "masg":
                log(data.name + "傳送了:" + data.masg);
                break;
            case "start":
                raisenum = '';
                raisemax = 0;
                raisemin = 0;
                raisenum1 = 0;


                for (var i = 0; i <= data.online.length; i++) {
                    user[data.online[i]] = true;
                    raisenum[i] = 0;
                }
                $('.gitporker').click();

                poker = data.poker;
                for (var i = 1; i < 9; i++) {
                    if (user[i]) {
                        $('.user' + i).css("border-style", "dashed");
                        $('.user' + i).css("border-color", "black");
                        $('.user' + i).html('<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />');
                        if (i == id) {
                            $('.user' + id).html('<div class="item"><img data="' + poker[0 + (i * 4)] + '" src="img/' + poker[0 + (i * 4)] + '.svg" /></div>' + '<div class="item"><img data="' + poker[1 + (i * 4)] + '" src="img/' + poker[1 + (i * 4)] + '.svg" /></div>' + '<div class="item"><img data="' + poker[2 + (i * 4)] + '" src="img/' + poker[2 + (i * 4)] + '.svg" /></div>' + '<div class="item"><img data="' + poker[3 + (i * 4)] + '" src="img/' + poker[3 + (i * 4)] + '.svg" /></div>');
                        }
                    } else {
                        $('.user' + i).empty();
                        $('.user' + i).css("border-style", "");
                    }
                }
                $('.online').html('');

                drop(id);

                break;
            case "check":
                for (var i = 0; i <= data.online.length; i++) {
                    user[data.online[i]] = true;
                }
                $('.check').click();
                var upnum = [];
                var downunm = [];
                pokered = data.pokered;
                for (var i = 0; i <= data.online.length; i++) {
                    if (user[i]) {
                        console.log(i, data.online);
                        $('.user' + i).html('<img src="img/' + pokered[0 + (i * 4)] + '.svg" />' + '<img src="img/' + pokered[1 + (i * 4)] + '.svg" />' + '<img src="img/' + pokered[2 + (i * 4)] + '.svg" />' + '<img src="img/' + pokered[3 + (i * 4)] + '.svg" />');
                        changnum(pokered[0 + (i * 4)], pokered[1 + (i * 4)], pokered[2 + (i * 4)], pokered[3 + (i * 4)]);
                        $('.online').append(data.name1[i] + "第一副牌" + a + "第二副牌" + b + "<br>");
                    }
                }
                $('.user' + data.id).css("border-color", "red");
                $('.call').hide();
                if (data.id == id) {
                    money = parseInt($(".money").html());
                    $('.money').html(data.money + money);
                    log('賺了' + data.money);
                }
                if (data.lost) {
                    for (var i = 0; i <= data.lost.length; i++) {
                        user[data.lost[i]] = false;
                        $('.user' + data.lost[i]).empty();
                        $('.user' + data.lost[i]).css("border-style", "");
                        log(data.name1[data.lost[i]] + "被夾了");
                    }
                }
                if (data.online[0] == id) {
                    setTimeout(function() {
                        $('.tablemoney').html('');
                        $('.start').show();
                    }, 2000);
                } else {
                    setTimeout(function() {
                        $('.tablemoney').html('');
                    }, 2000);
                }
                break;
            case "raise":
                $('.tablemoney').html(data.tablemoney);
                raisemax = data.raisemax;
                raisemin = data.raisemin;

                raisenum = '';

                for (i in data.raisenum) {
                    raisenum = raisenum + data.name1[i] + "加碼次數" + data.raisenum[i] + "<br>";
                }
                $('.online').html(raisenum);
                if (raisenum1 < raisemax) {
                    $('.call').show();
                    $('.flod').show();

                } else {
                    $('.call').hide();
                }

                break;
            case "flod":
                user[data.userid] = false;
                $('.user' + data.userid).empty();
                $('.user' + data.userid).css("border-style", "");
                $('.online').html();
                raisemax = data.raisemax;
                raisemin = data.raisemin;
                break;
            case "quit":
                user[data.userid] = false;
                $('.user' + data.userid).empty();
                $('.user' + data.userid).css("border-style", "");
                break;
        }

        if (data.msg) {
            log(data.msg);
        }
        if (data.unid) {
            user[data.unid] = false;
        }
        tablemoney = data.tablemoney;
        $('.tablemoney').html(tablemoney);

    } else {
        if (e.data) {
            log(e.data);
        }
    }
};
websocket.onerror = function(e) {
    console.log(e);
    websocket.close();
};
websocket.onclose = function(e) {
    log("斷線 5 秒後重新整理");

    websocket.close();

    setTimeout(function() {
        location.reload();
    }, 5000);
};

function log(text) {
    $log = $('#log');
    //Add text to log
    $log.append(($log.val() ? "\n" : '') + text);
    //Autoscroll
    $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
}

function isJSON(str) {
    if (typeof str == 'string') {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }
}

function drop(id) {
    var bstop = true;
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
            $('.user' + id).append(clone); //追加到user里面
            $(this).addClass('moving').html(''); //被克隆的元素添加类移除内容
            $('.user' + id).on('mousemove', function(e) { //对克隆的盒子进行拖拽
                clone.css({
                    left: e.pageX - $(this).offset().left - disx,
                    top: e.pageY - $(this).offset().top - disy
                })

            });

            clone.on('mouseup', function() {
                $('.user' + id).off('mousemove'); //取消mousemove事件
                var minIndex = $(that).index(); //最小索引赋初始值
                var minValue = 1000; //初始化最小值，用来存储所有盒子的最小值
                $('.user' + id + ' div').not(':last').each(function() { //不包括克隆的那个盒子
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
                        bstop = true;
                    });
                } else {
                    var $minbox = $('.user' + id + ' div').eq(minIndex); //最小索引的盒子
                    var clone2 = $minbox.clone(); //克隆一个最小盒子的副本，添加相关样式
                    clone2.addClass('draging').css({
                        left: $minbox.position().left,
                        top: $minbox.position().top
                    })
                    $('.user' + id).append(clone2); //追加
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
}