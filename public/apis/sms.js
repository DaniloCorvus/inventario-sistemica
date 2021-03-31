
const formsms = document.getElementById('formsms')

formsms.addEventListener('submit', function () {
    event.preventDefault()

    let bodysms = new FormData(formsms)
    axios.post(formsms.action, bodysms).then(res => {
        console.log(res.data);
        toastr.info('Success:', res.data);
    })
        .catch(error => console.error('Error:', error))
})