document.getElementById('form').onsubmit = async (e) => {
    e.preventDefault();
    var elemMessage = document.getElementById('message');
    elemMessage.style.display = 'none';

    data = {
        username: document.getElementById('inputUsername').value,
        password: document.getElementById('inputPassword').value
    }

    document.getElementById('inputUsername').value = "";
    document.getElementById('inputPassword').value = "";

    let response = await fetch(document.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
    });

    let jsonResponse = await response.json();

    if (jsonResponse) {
        elemMessage.innerHTML = jsonResponse.msg;
        elemMessage.className = "alert alert-" + jsonResponse.state;
        elemMessage.style.display = 'block';
    }
};
