document.addEventListener('DOMContentLoaded', function () {
    const newImageInput = document.querySelector('#profile');
    const imgProfileCtn = document.querySelector('.img-profile');

    // Função de animação que atualiza a imagem do perfil
    function updateImage(event) {
        const newImage = URL.createObjectURL(event.target.files[0]);

        duracao = 2;

        imgProfileCtn.style.backgroundImage = `url(${newImage})`;
        imgProfileCtn.style = `animation: ChangeImage ${duracao}s forwards;`;

        setTimeout(() => {
            console.log('hmm');
            document.querySelector('#profileImg').src = newImage;
        }, (duracao / 2.2) * 1000);

    }

    newImageInput.addEventListener('change', updateImage);

    // Remove a animação de troca de imagem
    imgProfileCtn.addEventListener('animationend', function() {
        imgProfileCtn.style = '';
    });   
});