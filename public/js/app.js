new WOW().init();


// Untuk Teks Berjalan
const textElement = document.getElementById('jalan');
const text = textElement.innerText;
textElement.innerText = '';

let i = 0;
function type() {
    if (i < text.length) {
        textElement.innerHTML += text.charAt(i);
        i++;
        setTimeout(type, 70);
    }
}

type(); 
// End Teks Berjalan
