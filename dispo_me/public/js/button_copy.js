var btn = document.querySelector('#copy');

btn.addEventListener('click', function (event) {
    var input = document.querySelector('#input');
    var range = document.createRange();
    range.selectNode(input);
    window.getSelection().addRange(range);

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'réussi' : 'échoué';
        console.log('La copie du lien unique dans le bloc-note a ' + msg);
    } catch (err) {
        console.log('Impossible de copier');
    }

    window.getSelection().removeAllRanges();
});
