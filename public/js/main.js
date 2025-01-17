document.addEventListener('DOMContentLoaded', function () {

    const lightBall = document.querySelector('.light-ball');
    const sideBar = document.querySelector('.side-bar');
    const allNavLinks = document.querySelectorAll('.nav-link');
    const modalBackDrop = document.querySelector('.modal-back-blur');

    /**
     * Função que atualiza a posição da bola de luz
     * @param {*} event 
     */
    function updateBallPosition(event) {
        
        if (event.touches) {
            newPosX = event.touches[0].clientX - (lightBall.offsetWidth / 2)
            newPosY = event.touches[0].clientY - (lightBall.offsetHeight / 2)
        } else {
            newPosX = event.pageX - (lightBall.offsetWidth / 2)
            newPosY = event.pageY - (lightBall.offsetHeight / 2)
        }
        
        lightBall.style.left = `${newPosX}px`;
        lightBall.style.top = `${newPosY}px`;
    }

    if (lightBall) {
        window.addEventListener('mousemove', updateBallPosition);
        window.addEventListener('touchmove', updateBallPosition);
        window.addEventListener('wheel', function (event) {
            updateBallPosition(event);
        });
    }

    /**
     * Função que atualiza o angulo dos links
     * @param {*} event 
     */
    function angleNavLinks(event) {
        allNavLinks.forEach(function (element) {
            elemPosX = element.offsetLeft;
            elemPosY = element.offsetTop;

            if (event.touches){
                mouseX = event.touches[0].clientX;
                mouseY = event.touches[0].clientY;
            } else {
                mouseX = event.clientX;
                mouseY = event.clientY;
            }

            angleX = -((mouseY - elemPosY) / 17);
            angleY = -((mouseX - elemPosX) / 17);

            distanceZ = Math.sqrt(angleX ** 2 + angleY ** 2) * 0.1;

            scale = 0.95 + (distanceZ / 1000) * 1.5;

            element.style.transform = `perspective(250px) rotateX(${angleX}deg) translateZ(${distanceZ}px)`;
            element.style.scale = `${scale}`;
        });
    }

    /**
     * Função que fecha o modal
     * @param {*} event
     */
    function closeModal() {
        modalBackDrop.remove();
    }

    /**
     * Fumção que verifica se o click foi no modal
     * @param {*} event 
     */
    function checkModalClick(event) {
        modalContainer = modalBackDrop.querySelector('.modal-container');

        if (event.target === modalBackDrop) {
            closeModal();
        }
    }

    if (modalBackDrop) {
        btnClose = modalBackDrop.querySelector('.close-modal');

        modalBackDrop.addEventListener('click', checkModalClick);
        btnClose.addEventListener('click', closeModal);
    }

    window.addEventListener('mousemove', angleNavLinks);
    window.addEventListener('touchmove', angleNavLinks)
});
