document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementById('questions');
    form && form.addEventListener('submit', function (e) {
        e.preventDefault();
        var enableToSend = 1,
            errFormMsg = '',
            sendTo = this.dataset.target;
        this.querySelectorAll('input').forEach(function (inp) {
            if (inp.value === '') {
                enableToSend = 0;
            }
        });
        errFormMsg = errFormMsg != '' ? errFormMsg : 'Please, fill form';
        if (enableToSend) {
            var inpName = document.querySelector('input[name=name]'),
                inpPhone = document.querySelector('input[name=phone]'),
                xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://www.leshiy.space/partials/questions.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    inpName.value = '';
                    inpPhone.value = '';
                    alert('Thank You! We will contact you soon.');
                }
            };
            xhr.send('name=' + inpName.value + '&phone=' + inpPhone.value + '&sendto=' + sendTo);
        } else {
            alert(errFormMsg);
        }
    });
});
