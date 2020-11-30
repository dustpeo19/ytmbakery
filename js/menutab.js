//메뉴 탭
var targetLink=document.querySelectorAll('.headermenu a');
var tabContent=document.querySelectorAll('.headermenu li > div');

for(var i=0;i<targetLink.length;i++){
    targetLink[i]=addEventListener('mouseover',function(e){
        e.preventDefault();
        var tabTarget=e.target.getAttribute('name');
        console.log(document.getElementById(tabTarget));

        for(var j=0;j<tabContent.length;j++){
            tabContent[j].classList.remove('active');
            targetLink[j].classList.remove('active');
        }

        document.getElementById(tabTarget).classList.add('active');
        e.target.classList.add('active');

    });

    //어떻게 해야 a 밖으로 마우스가 나가도 탭을 펼쳐지게 할 수 있을까?

    // targetLink[i]=addEventListener('mouseleave',function(e){
    //     for(var j=0;j<targetLink.length;j++){
    //         targetLink[j].classList.add('active');
    //     }
    // });
}

// for(var i=0;i<tabContent.length;i++){
//     tabContent[i]=addEventListener('mouseover',function(e){
//         e.preventDefault();
//         var tabTarget=e.target.getAttribute('name');

//         document.getElementById(tabTarget).style.display='block';

//     });
// }