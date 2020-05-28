function toolbox() {
    var tooltips = document.querySelectorAll('.leaf__icon');

    tooltips.forEach((tooltip) => {

        tooltip.addEventListener('mouseover', function (e) {
            let target = e.currentTarget;
            let parent = target.parentNode;

            let description = parent.querySelector('.leaf__description');
            description.classList.add('leaf__description--show');
        });

        tooltip.addEventListener('mouseleave', function (e) {
            let target = e.currentTarget;
            let parent = target.parentNode;

            let description = parent.querySelector('.leaf__description');
            description.classList.remove('leaf__description--show');
        })

    })
}

window.addEventListener("load", toolbox);
