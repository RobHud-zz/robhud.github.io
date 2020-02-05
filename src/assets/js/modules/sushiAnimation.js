import {TimelineMax, Power4, Back } from "gsap/all";


function init404Animation() {
    let beginAnimation = new TimelineMax({repeat: -1});
    beginAnimation.from('.suushi-container',3,{y:-200, ease:Back.easeOut})
        .to('.chopstick-container', 1.5, {top: 0}, 1.5)
        .to('.chopstick1', 2, {rotation:10}, 3.5)
        .to('.chopstick2', 2, {rotation:-10}, 3.5)
        .to('.shine-left', .5, {left:'36.3%'}, 4.2)
        .to('.shine-right', .5, {left:'45.5%'}, 4.2)
        .to('.mouth', .5, {borderRadius: '90% 90% 10% 10%'}, 4.2)
        .to('.shine-left', .5, {left:'35%',top:'68.8%',width:'16px',height:'16px'}, 5.2)
        .to('.shine-right', .5, {left:'44%',top:'69.8%',width:'16px',height:'16px'}, 5.2)
        .to('.roll', 3, {animation:'shake 0.5s 3'}, 5.7)
        .to('.suushi-container',0.6,{ease:Power4.easeOut, y:-600}, 6.7)
        .to('.repeat', 4, {animation: 'fade-in 3s forwards'}, 7.5);
}

export default {init: init404Animation}