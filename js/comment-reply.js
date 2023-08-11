// Fungsi JavaScript untuk menampilkan form reply yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector(".container-comments");
    const replyButtons = document.querySelectorAll(`.btn-reply`);
    const batalButtons = document.querySelectorAll('.btn-batal'); 

    container.addEventListener('click', function(e) {
        if(container.target.className == 'btn-reply')
        {
            console.log('oke');
        }
    })

    replyButtons.forEach((button) => {
        button.addEventListener('click', function(e) {
            e.target.parentElement.parentElement.nextElementSibling.nextElementSibling.style.display = 'flex'
        });
    });

    batalButtons.forEach((batal) => {
        batal.addEventListener("click", (e)=>{
            e.target.parentElement.parentElement.parentElement.style.display = "none";
        })
    })

})