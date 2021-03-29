let isDisplay = true;

function handleClickSpoiler() {
    console.log('handleClickSpoiler', isDisplay);
    //vérifier l'état du booléen isDislay
    if (isDisplay === true) {
        //alors on cache le texte
        document.getElementById('js-form-spoiler').className = '';
        //on change la variable isDisplay à false
        //ça précise que le texte est caché
        isDisplay = false;

    }
    else{
        document.getElementById('js-form-spoiler').className = 'app-spoiler';
        isDisplay = true;
    }

}
