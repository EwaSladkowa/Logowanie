
/*function Login(){
    var Login = document.getElementById('login-input').value;
    var Password = document.getElementById('password-input').value;
    alert("Login: " + Login + "  Password: " + Password);
}*/

console.log("fuyghyjgk");
        const queryString =  new URLSearchParams(window.location.search);
        const error = queryString.get('message');
        sh = document.getElementById('errorjs');
        sh.style.display = 'none';
        if(queryString.get('message')){
            sh.style.display = "block";
            setTimeout(function(){sh.style.display = 'none'}, 2000);
        }