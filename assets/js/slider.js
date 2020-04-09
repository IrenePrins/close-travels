import { tns } from '../../node_modules/tiny-slider/src/tiny-slider'

//add responsive
var slider = tns({
    container: '.detail__slider',
    items: 3,
    slideBy: '1',
    autoplay: true,
    controls: false,
    navPosition: "bottom",
});
