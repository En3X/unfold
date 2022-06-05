const QUOTE_API = "https://type.fit/api/quotes";

fetch(QUOTE_API).then(data=>{
    return data.json()
}).then(jsonquotes => {
    count = Math.floor(Math.random()*jsonquotes.length);
    quote = jsonquotes[count];
    // console.log(quote);
    document.querySelector('#quote').textContent = quote.text;
    document.querySelector('#author').textContent = quote.author;
})


function setToast(msg) {
    document.querySelector("#toast").textContent = msg;
}


pwd = document.querySelector('#password');
retypePwd = document.querySelector('#retypePassword');
retypePwd.addEventListener('input',(e)=>{
    if (pwd.value.length < 8) {
        return;
    }
    isPasswordSame();
})

pwd.addEventListener('input',()=>{
    if (pwd.value.length < 8) {
        document.querySelector("#signupBtn").style.cursor = 'not-allowed';
        document.querySelector("#signupBtn").title = "Password should atleast have 8 characters!";
        document.querySelector("#signupBtn").disabled = true;
        return;
    }else{
        document.querySelector("#signupBtn").style.cursor = 'pointer';
        document.querySelector("#signupBtn").title = "";
        document.querySelector("#signupBtn").disabled = false;
        isPasswordSame();
    }

})

function isPasswordSame() {
    if (retypePwd.value !== pwd.value) {
        document.querySelector("#signupBtn").style.cursor = 'not-allowed';
        document.querySelector("#signupBtn").title = "Passwords do not match!";
        document.querySelector("#signupBtn").disabled = true;
    }else{
        document.querySelector("#signupBtn").style.cursor = 'pointer';
        document.querySelector("#signupBtn").title = "";
        document.querySelector("#signupBtn").disabled = false;
    }
}