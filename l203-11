<style>
 h1{
 text-align:center;
 }
 .box{
 width:10%;
 height:80px;
 background:#ff5722;
 float:left;
 margin:.5%;
 padding: 5%;
 border-radius:15px;
 }
</style>
<script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="src/skroll.min.js" type="text/javascript"></script>

----------------------------------------------------------

<div class="box header"><h1>A</h1></div>
<div class="box anim1"><h1>B</h1></div>
<div class="box anim2"><h1>C</h1></div>
<div class="box anim3"><h1>D</h1></div>
<div class="box anim4"><h1>E</h1></div>
<div class="box anim5"><h1>F</h1></div>
<div class="box anim6"><h1>G</h1></div>
<div class="box anim7"><h1>H</h1></div>
<div class="box anim8"><h1>I</h1></div>

<script>
 var skroll = new Skroll()
 .add(".header",{
 animation:"zoomIn",
 duration:600
 })
 .add(".anim1",{
 animation:"fadeInUp",
 delay:120,
 duration:600,
 wait:250
 })
 .add(".anim2",{
 animation:"flipInX",
 delay:120,
 duration:750
 })
 .add(".anim3",{
 animation:"rotateLeftIn",
 delay:100,
 duration:750
 })
 .add(".anim4",{
 animation:"slideInLeft",
 delay:80,
 duration:800
 })
 .add(".anim5",{
 animation:"growInLeft",
 delay:80,
 duration:500,
 easing:"cubic-bezier(0.37, 0.27, 0.24, 1.26)"
 })
 .add(".anim6",{
 animation:"growInRight",
 delay:80,
 duration:500,
 easing:"cubic-bezier(0.37, 0.27, 0.24, 1.26)"
 })
 .addAnimation("spinIn",{
 start:function(el){
 $(el).css({
 transform:"rotate(-360deg) scale(.2,.2)",
 transformOrigin:"50% 50%",
 opacity:0
 });
 },
 end:function(el){
 $(el).css({
 transform:"rotate(0deg) scale(1,1)",
 opacity:1
 })
 }
 })
 .add(".anim7",{
 animation:"spinIn",
 delay:80,
 duration:500,
 easing:"cubic-bezier(0.37, 0.27, 0.24, 1.26)"
 })
 .add(".anim8",{
 animation:"fadeInDown",
 delay:75,
 duration:150,
 triggerBottom:.98,
 easing:"cubic-bezier(0.37, 0.27, 0.24, 1.26)"
 })
 .init();
 $(window).load(function(e){
 skroll.recalcPosition();
 })
 setInterval(function(){
 skroll.recalcPosition();
 },2000)
</script>
