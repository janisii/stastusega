(() => {

    const buttonsFrameImageCoords = document.querySelectorAll('.btn-frames-image-coords');
    const linkFrameImageAttach = document.querySelectorAll('.frame-image-attach');
    const buttonsFrameImageRemove = document.querySelectorAll('.btn-frame-image-remove');

    if (buttonsFrameImageCoords && buttonsFrameImageCoords.length > 0) {

        buttonsFrameImageCoords.forEach( button => {
            button.addEventListener('click', initRowsCols)
        });

        function initRowsCols(e) {
            document.querySelector('#frame-row').value = e.target.dataset.row;
            document.querySelector('#frame-col').value = e.target.dataset.col;
        }

    }

    if (linkFrameImageAttach && linkFrameImageAttach.length > 0) {

        linkFrameImageAttach.forEach( image => {
            image.addEventListener('click', frameImageAttach);
        });

        function frameImageAttach(e) {
            e.preventDefault();

            const link = e.path[1];
            const frameId = document.querySelector('#frame-id').value;
            const row = document.querySelector('#frame-row').value;
            const col = document.querySelector('#frame-col').value;

            location.href = `${link.dataset.action}/?image_id=${link.dataset.image}&frame_id=${frameId}&row=${row}&col=${col}`;
        }

    }

    if (buttonsFrameImageRemove && buttonsFrameImageRemove.length > 0) {

        buttonsFrameImageRemove.forEach( btn => {
            btn.addEventListener('click', frameImageRemove);
        });

        function frameImageRemove(e) {
            e.preventDefault();
            if (confirm('Vai tiešām vēlaties noņemt attēlu?')) {
                const {action, frame, image, row, col} = e.target.dataset;
                location.href = `${action}/?image_id=${image}&frame_id=${frame}&row=${row}&col=${col}`;
            }
        }

    }

})();