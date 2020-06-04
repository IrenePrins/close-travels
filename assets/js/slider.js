import { tns } from '../../node_modules/tiny-slider/src/tiny-slider'

function slider() {

    let tnsSlider = document.body.querySelector('.detail__slider');

    if (tnsSlider === undefined || tnsSlider == null    ) {
        return;
    }

    //add responsive
    var slider = tns({
        container: '.detail__slider',
        items: 3,
        slideBy: '1',
        autoplay: true,
        controls: false,
        navPosition: "bottom",
    });
}

window.addEventListener('load', slider);

