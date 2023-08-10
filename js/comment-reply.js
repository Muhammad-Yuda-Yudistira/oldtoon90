// Fungsi JavaScript untuk menampilkan form reply yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const replyButtons = document.querySelectorAll(`.btn-reply`);
    const batalButtons = document.querySelectorAll('.btn-batal'); 

    replyButtons.forEach((button) => {
        button.addEventListener('click', function(e) {
            e.target.parentElement.parentElement.nextElementSibling.style.display = 'flex'
        });
    });

    batalButtons.forEach((batal) => {
        batal.addEventListener("click", (e)=>{
            e.target.parentElement.parentElement.parentElement.style.display = "none";
        })
    })

})