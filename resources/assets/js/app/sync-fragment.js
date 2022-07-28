(() => {

    const syncFragmentInputs = document.querySelectorAll('.sync-fragment-input');

    if (syncFragmentInputs && syncFragmentInputs.length > 0) {

        const form = document.querySelector('#sync-image-fragment');
        syncFragmentInputs.forEach( item => {
            item.addEventListener('click', (e) => {
                const fragmentId = e.target.value;
                const tableRow = document.querySelector('#sync-fragment-row-' + fragmentId);
                const fragmentLabel = document.querySelector('#sync-fragment-label-' + fragmentId);

                const syncUrl = form.action;

                let formData = new FormData(form);
                formData.append('fragment', fragmentId);

                let fetchData = {
                    method: 'POST',
                    body: formData,
                    headers: new Headers()
                };

                fetch(syncUrl, fetchData)
                    .then( res => res.json() )
                    .then( data => {
                        if (data.success === true) {
                            fragmentLabel.innerHTML = 'Saglabāts!';
                            setTimeout( function(){
                                tableRow.remove();
                            }, 1000);
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                    });

            });
        });

    }

})();