<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/10
 * Time: 18:11
 */

?>

<html>
<head>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <script>
        function sha1(data){
            /**************************************************
             Author：次碳酸钴（admin@web-tinker.com）
             Input：Uint8Array
             Output：Uint8Array
             **************************************************/
            var i,j,t;
            var l=((data.length+8)>>>6<<4)+16,s=new Uint8Array(l<<2);
            s.set(new Uint8Array(data.buffer)),s=new Uint32Array(s.buffer);
            for(t=new DataView(s.buffer),i=0;i<l;i++)s[i]=t.getUint32(i<<2);
            s[data.length>>2]|=0x80<<(24-(data.length&3)*8);
            s[l-1]=data.length<<3;
            var w=[],f=[
                    function(){return m[1]&m[2]|~m[1]&m[3];},
                    function(){return m[1]^m[2]^m[3];},
                    function(){return m[1]&m[2]|m[1]&m[3]|m[2]&m[3];},
                    function(){return m[1]^m[2]^m[3];}
                ],rol=function(n,c){return n<<c|n>>>(32-c);},
                k=[1518500249,1859775393,-1894007588,-899497514],
                m=[1732584193,-271733879,null,null,-1009589776];
            m[2]=~m[0],m[3]=~m[1];
            for(i=0;i<s.length;i+=16){
                var o=m.slice(0);
                for(j=0;j<80;j++)
                    w[j]=j<16?s[i+j]:rol(w[j-3]^w[j-8]^w[j-14]^w[j-16],1),
                        t=rol(m[0],5)+f[j/20|0]()+m[4]+w[j]+k[j/20|0]|0,
                        m[1]=rol(m[1],30),m.pop(),m.unshift(t);
                for(j=0;j<5;j++)m[j]=m[j]+o[j]|0;
            }
            t=new DataView(new Uint32Array(m).buffer);
            for(var i=0;i<5;i++)m[i]=t.getUint32(i<<2);
            return new Uint8Array(new Uint32Array(m).buffer);
        }
        function encodeUTF8(s){
            var i,r=[],c,x;
            for(i=0;i<s.length;i++)
                if((c=s.charCodeAt(i))<0x80)r.push(c);
                else if(c<0x800)r.push(0xC0+(c>>6&0x1F),0x80+(c&0x3F));
                else {
                    if((x=c^0xD800)>>10==0) //对四字节UTF-16转换为Unicode
                        c=(x<<10)+(s.charCodeAt(++i)^0xDC00)+0x10000,
                            r.push(0xF0+(c>>18&0x7),0x80+(c>>12&0x3F));
                    else r.push(0xE0+(c>>12&0xF));
                    r.push(0x80+(c>>6&0x3F),0x80+(c&0x3F));
                }
            return r;
        }
    </script>
    <script>
        $.ajax({
            url: "./wxapi_pack/get_wx_info.php",
            type: "POST",
            dataType: 'jsonp',
            jsonp: 'callback',
            timeout: 5000,
            success: function (json) {
                var timestamp = Math.round(new Date().getTime()/1000);
                var str1 = "jsapi_ticket=" + json['ticket'] + "&noncestr=" + json['noncestr'] + "&timestamp=" + timestamp +
                            "&url=http://mytaotao123.sinaapp.com/wxapi.php";
                var data = new Uint8Array(encodeUTF8(str1));
                var result = sha1(data);
                var hex = Array.prototype.map.call(result,function(e){
                    return (e<16?"0":"")+e.toString(16);
                }).join("");
                wx.config({
                    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId: 'wx29cc85099ab49c0a', // 必填，公众号的唯一标识
                    timestamp: timestamp, // 必填，生成签名的时间戳
                    nonceStr: json['noncestr'][0], // 必填，生成签名的随机串
                    signature: hex,// 必填，签名，见附录1
                    jsApiList: ["chooseImage","startRecord","stopRecord","playVoice","onVoiceRecordEnd"] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
                });
            }
        });
    </script>
</head>
<body>
<script>
    wx.ready(function(){
        var localId = '';
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
        $('#record').on('click',function() {
            wx.startRecord();
            wx.onVoiceRecordEnd({
                // 录音时间超过一分钟没有停止的时候会执行 complete 回调
                complete: function (res) {
                    localId = res.localId;
                }
            });
        });
        $('#recordStop').on('click',function() {
            wx.stopRecord({
                success: function (res) {
                    localId = res.localId;
                }
            });
        });
        $('#recordPlay').on('click',function() {
            alert(localId);
            wx.playVoice({
                localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });
        });


    });
</script>
<button id="record">Start</button>
<button id="recordStop">Stop</button>
<button id="recordPlay">Play</button>

</body>
</html>