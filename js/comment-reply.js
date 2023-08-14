// Fungsi JavaScript untuk menampilkan form reply yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector(".container-comments");
    // const batalButtons = document.querySelectorAll('.btn-batal'); 

    container.addEventListener('click', function(e) {
        if(e.target.className == 'lipatan')
        {
            if(e.target.children[0].innerHTML == "⤴")
            {
                e.target.children[0].innerHTML = "&#x2935;"
            }
            else 
            {
                e.target.children[0].innerHTML = "&#x2934;";
            }
            e.target.nextElementSibling.classList.toggle("hidden")
        }
        if(e.target.className == 'btn-reply')
        {
            const commentId = e.target.dataset.commentId
            const commentBox = document.querySelector(`.comment-box[data-comment-id="${commentId}"]`)
            commentBox.style.display = 'block'
            e.target.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'flex'
        }
        if(e.target.className == 'btn-batal')
        {
            console.log(e.target.dataset.commentId)
        }
    })

    // batalButtons.forEach((batal) => {
    //     batal.addEventListener("click", (e)=>{
    //         e.target.parentElement.parentElement.parentElement.style.display = "none";
    //     })
    // })

})