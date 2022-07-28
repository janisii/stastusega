var isAdvancedUpload = function() {
    var div = document.createElement('div');
    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();

var input = false;
var droppedFiles = false;
var form = document.querySelector('.form__dragndrop') || false;

if (isAdvancedUpload && form) {

    var html = document.querySelector('html').classList.add('js');
    var input = form.querySelector('input[type="file"]');

    form.classList.add('has-advanced-upload');

    form.addEventListener('drag', prevent);
    form.addEventListener('dragstart', prevent);
    form.addEventListener('dragend', prevent);
    form.addEventListener('dragover', prevent);
    form.addEventListener('dragenter', prevent);
    form.addEventListener('dragleave', prevent);
    form.addEventListener('drop', prevent);

    form.addEventListener('dragover', dragOver);
    form.addEventListener('dragenter', dragOver)

    form.addEventListener('dragleave', dragLeave);
    form.addEventListener('dragend', dragLeave);
    form.addEventListener('drop', dragLeave);

    form.addEventListener('drop', drop);
    form.addEventListener('submit', uploadSubmit)

}

function uploadSubmit(e) {
    if (form.classList.contains('is-uploading')) {
        return false;
    }

    form.classList.add('is-uploading');
    form.classList.remove('is-error');

    if (isAdvancedUpload) {
        e.preventDefault();
        var formData = new FormData(form);

        if (droppedFiles) {
            Array.from(droppedFiles).forEach( file => {
                formData.append(input.getAttribute('name'), file);
            });
            // log / debug
            // for (var [key, value] of formData.entries()) console.log(key, value);
        }

        var actionUrl = form.getAttribute('action');

        let fetchData = {
            method: 'POST',
            body: formData,
            headers: new Headers()
        };

        fetch(actionUrl, fetchData)
            .then( res => res.json() )
            .then( data => {
                form.classList.remove(data.success == true ? 'is-uploading' : '');
                form.classList.add(data.success == true ? 'is-success' : 'is-error');
            })
            .catch(function(error) {
                console.error(error);
            });
    }
}

function drop(e) {
    droppedFiles = e.dataTransfer.files;
    const event = new Event('submit');
    form.dispatchEvent(event);
}

function dragOver() {
    form.classList.add('is-dragover');
}

function dragLeave() {
    form.classList.remove('is-dragover');
}

function prevent(e) {
    e.preventDefault();
    e.stopPropagation();
}