function callAPI(url, callBack, finallyCallback = null) {
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => response.json())
        .then(data => callBack(data))
        .catch(error => console.error(error))
        .finally(() => {
            if (finallyCallback) {
                finallyCallback();
            }
        });
}