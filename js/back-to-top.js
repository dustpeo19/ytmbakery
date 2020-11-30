var btt=document.getElementById('back-to-top'),
    docElem=document.documentElement,
    offset,
    scrollPos,
    docHeight;

//문서 높이 계산
docHeight=Math.max(docElem.scrollHeight,docElem.offsetHeight);
if(docHeight!=0){
    offset=docHeight/4;
}

//스크롤 이벤트 추가
window.addEventListener('scroll',function(){
    scrollPos=docElem.scrollTop;
    btt.className=(scrollPos>offset) ? 'visible' : '';
});

//클릭 이벤트 추가
btt.addEventListener('click',function(ev){
    ev.preventDefault();
    scrollToTop();
});
function scrollToTop(){
    var scrollInterval = setInterval(function(){
        if(scrollPos!=0){
            window.scrollBy(0,-55);
        }else{
            clearInterval(scrollInterval);
        }
    },15);
}