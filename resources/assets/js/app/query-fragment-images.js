(() => {

    const queryImageListResults = document.querySelector('.query-image-list-results');
    if (queryImageListResults && images.length > 0) {

        let attachLink = queryImageListResults.dataset.attachLink;
        const input = document.querySelector('input[name="query-image-list-input"]');

        input.addEventListener('keyup', filtering);

        function filtering(e) {
            let query = input.value;
            if (query.length > 0) {
                let filteredImages = images.filter(image => {
                    const regex = new RegExp(query, 'gi');
                    return image.filename_ori.match(regex);
                });
                displayResults(filteredImages);
            } else {
                displayResults([]);
            }
        }

        function displayResults(images) {
            const html = images.map( image => {
                return `
                    <li class="list-inline-item mt-3">
                        <a href="${attachLink.replace('-1', image.id)}" title="">
                            <img src="/i/${image.filename}?w=100&h=100&fit=crop" title="${image.filename_ori}" alt="${image.filename_ori}" class="rounded">
                            <p>${image.filename_ori}</p>
                        </a>
                    </li>
                `;
            }).join('');

            queryImageListResults.innerHTML = html;
        }
    }

})();